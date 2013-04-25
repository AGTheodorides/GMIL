function add_submit_listeners(scope)
{

	if (!scope)
	{
		scope = $(document);
	}

	scope.on('click', '.submit-button', function()
	{
		
		var options;
		
		if ($(this).attr('options'))
		{
			options = JSON.parse($(this).attr('options'));
		}
		
		submit_form_data(this, options);
		
	});
	
}
function add_editable_listeners(scope)
{
	
	scope.on('mouseover', '.editable', function()
	{ 
		if ($(this).find('.editable-editor').length)
		{
			$(this).addClass('editable-viewer-highlight');
		}
	});
	
	scope.on('mouseout', '.editable', function()
	{ 
		if ($(this).find('.editable-editor').length)
		{
			$(this).removeClass('editable-viewer-highlight');
		}
	});

	scope.on('click', '.editable-viewer', function()
	{ 
		
		// Find parent editable div
		var editable = $(this).closest('.editable');
		var editor = editable.find('.editable-editor');

		speed = 250;
		
		if (editor.length)
		{
			
			// Hide viewer
			$(this).fadeOut(speed, function()
			{
				
				// Show editor
				editor.fadeIn(speed);
				
			});
			
		}
		
	});

	scope.on('click', '.editable-editor-exit-button', function()
	{ 
		
		// Find parent editable and editor divs
		var editable = $(this).closest('.editable');
		var editor = $(this).closest('.editable-editor');
		
		speed = 250;
		
		// Hide editor
		editor.fadeOut(speed, function()
		{
		
			// Show editor
			editable.find('.editable-viewer').fadeIn(speed);
			
		});
		
	});

}

function submit_form_data(control, options)
{

	try
	{
		
		// Find parent part and form divs
		var part = $(control).closest('.part');
		var form = $(control).closest('form');
	
		// Default behavior
		var action;							// Action url
		var refresh;						// Refresh url 
		var area;								// Refresh an area only
		var parts;							// Additional parts to refresh
		var redirect;						// Redirect url when done
		
		// Default action url
		if (form.attr('action'))
		{
			action = form.attr('action');
		}
		else if (part.attr('action'))
		{
			action = part.attr('action');
		}
		
		// Default refresh url
		if (part.length)
		{
			refresh = part.attr('src');
		}
		else
		{
			refresh = window.location;
		}
		
		// Override default behavior
		if (typeof options != "undefined")
		{
			if (typeof options["area"] != "undefined")
			{
				area = options["area"];
			}
			if (typeof options["action"] != "undefined")
			{
				action = options["action"];
			}
			if (typeof options["refresh"] != "undefined")
			{
				refresh = options["refresh"];
			}
			if (typeof options["parts"] != "undefined")
			{
				parts = options["parts"];
			}
			if (typeof options["redirect"] != "undefined")
			{
				redirect = options["redirect"];
			}
		}
		
		// Call ajax method
		form.ajaxSubmit({
			url: action, 
			type: "POST",
			success: function(responseText, statusText)
			{
				try
				{
				
					var response = JSON.parse(responseText);
					
					if (response.success)
					{
					
						// Refresh additional parts
						if (parts)
						{
							if (parts instanceof Array)
							{
								for (var i in parts) 
								{
									if (parts[i] == "parent")
									{
										load_part(part.parent().closest(".part"));
									}
									else
									{
										load_part($(parts[i]));
									}
								}
							}
							else
							{
								if (parts == "parent")
								{
									load_part(part.parent().closest(".part"));
								}
								else
								{
									load_part($(parts));
								}
							}
						}

						// Redirect
						if (redirect)
						{
							if (redirect == 'back')
							{
								navigate_to(document.referrer);
							}
							else if (redirect == 'self')
							{
								navigate_to(window.location);
							}
							else
							{
								navigate_to(redirect);
							}
						}
						
						// Refresh
						if (refresh)
						{
							if (part.length)
							{
								// Refresh part or area of the part
								load_part(part, area);
							}
							else 
							{
								if (!area)
								{
									// Reload entire page
									load(
									{
										url: window.location,
										completed: function()
										{
											load_parts($("#" + area));
										},
										help: 'form_refresh_entire_page_no_area'
									});
								}
								else
								{
									load(
									{
										target: $("#" + area), 
										source: "#" + area,
										url: window.location,
										completed: function()
										{
											load_parts($("#" + area));
										},
										help: 'form_refresh_entire_page_with_area'
									});
								}
							}
						}

						// Display success message
						form.find('.form-success').fadeIn();
						form.find('.form-error').fadeOut();
						form.find('.form-success').html(response.message).fadeIn();
												
					}
					else
					{
						// Display error message
						form.find('.form-success').fadeOut();
						form.find('.form-error').fadeIn();
						form.find('.form-error').html(response.message).fadeIn();
					}
				
				}
				catch(e)
				{
					// Display error message
					form.find('.form-success').fadeOut();
					form.find('.form-error').fadeIn();
					form.find('.form-error').html('<p onclick="$(this).next().fadeToggle();"> there was an error completing the request. (controller) </p><div class="error-content"> <p>error=' + e + '</p><p>responseText='  + responseText + '</p><p>trace='  + e.stack + '</p></div>').fadeIn();
					throw e;
				}
			},
			error: function(xhr)
			{
				// Display error message
				form.find('.form-success').fadeOut();
				form.find('.form-error').fadeIn();
				form.find('.form-error').html('<p onclick="$(this).next().fadeIn();"> there was an error completing the request. (ajax) </p><div class="error-content"> <p>statusText=' + xhr.statusText + '</p><p>responseText='  + xhr.responseText + '</p></div>').fadeIn();
			}
		});
		
	}
	catch(e)
	{
		// Display error message
		form.find('.form-success').fadeOut();
		form.find('.form-error').fadeIn();
		form.find('.form-error').html('<p onclick="$(this).next().fadeIn();"> general error completing the request. </p><div class="error-content"> ' + 
			'<p> name=' + e.name + '</p>' + 
			'<p> message=' + e.message + '</p>' + 
			'<p> filename=' + e.fileName + '</p>' + 
			'<p> lienumber=' + e.lineNumber + '</p>' + 
			'<p> stack=' + e.stack + '</p>' + 
			'</div>'
			).fadeIn();
	}
	
}