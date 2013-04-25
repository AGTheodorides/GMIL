function add_table_listeners(scope)
{
	
	scope.on('mouseover', '.table-row', function()
	{ 
		$(this).addClass('table-row-highlight');
	});
	
	scope.on('mouseout', '.table-row', function()
	{ 
		$(this).removeClass('table-row-highlight');
	});

}