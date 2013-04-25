function load_part(part, area)
{

	var target = part.find(".part-content"),
		params = {};
	
	part.find("param").each(function(index)
	{
		
		var param = $(this);
	
		params[param.attr("name")] = param.attr("value");
	
	});
	
	if (area)
	{
		target = target.find("#" + area);
	}

	load(
	{
		target: target, 
		source: area ? "#" + area : null,
		data: params,
		url: part.attr('src'),
		completed: function()
		{
		
			load_parts(part);
			
			part.trigger('ready');
			
		},
		help: 'load_part'
	});
}

function load_parts(scope)
{
	scope.find('.part').each(function(index)
	{
	
		var part = $(this);
	
		// TODO: Validate user state
		
		load_part(part);
		
	});
}