function navigate_to(url)
{

	window.location = url;
	
	return false;
	
}

function load(options)
{

	var target = $('#body_content'),
		source = '#body_content',
		data,
		completed = options['completed'],
		url = window.location,
		help = options['help'];
	
	// Override default behavior
	if (typeof options != "undefined")
	{
		if (typeof options["target"] != "undefined")
		{
			target = options["target"];
		}
		if (typeof options["source"] != "undefined")
		{
			source = options["source"];
		}
		if (typeof options["completed"] != "undefined")
		{
			completed = options["completed"];
		}
		if (typeof options["url"] != "undefined")
		{
			url = options["url"];
		}
		if (typeof options["data"] != "undefined")
		{
			data = options["data"];
		}
	}	

	$.ajax({
		url: url,
		data: data,
		success: function(data) 
		{
			try
			{
				
				var storage = document.createElement('div');
		
				$(storage).hide();
				
				storage.innerHTML = data;
				
				speed = 250;
				
				target.fadeOut(speed, function()
				{
				
					if (source)
					{
						target.html($(storage).find(source).html());
					}
					else
					{
						target.html($(storage).html());
					}
					
					target.fadeIn(speed, function()
					{
					
						$(storage).remove();
					
						if (typeof(completed) !== 'undefined')
						{
							completed();
						}
					
					});
					
				});
				
				
			}
			catch(e)
			{
				alert(e + " [ " + help + " ] ");
				throw e;
			}
		}
	});		

}