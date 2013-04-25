var main_menu_id,
		sub_menu_id;

/*

		MAIN MENU

*/
		
function set_main_menu_id(id)
{
	if (id != main_menu_id)
	{

		clear_main_menu_id();

		main_menu_id = id;

		// Apply selected item class
		$('#' + main_menu_id).addClass('main-menu-item-selected', 'fast');

		// Quietly remove highlight class
		$('#' + main_menu_id).removeClass('main-menu-item-highlight', 'fast');

	}
}

function clear_main_menu_id()
{
	
	if (main_menu_id)
	{
		$('#' + main_menu_id).removeClass('main-menu-item-selected', 'fast');
	}
	
	main_menu_id = null;
	
}

function add_main_menu_listeners()
{

	$('.main-menu-item').mouseover(function()
	{ 
		if ($(this).attr('id') !== main_menu_id)
		{
			$(this).addClass('main-menu-item-highlight', 'fast');
		}
	});
	
	$('.main-menu-item').mouseout(function()
	{ 
		if ($(this).attr('id') !== main_menu_id)
		{
			$(this).removeClass('main-menu-item-highlight', 'fast');
		}
	});
	
	$('.main-menu-item').click(function()
	{ 
		if($(this).attr('src'))
		{
			navigate_to($(this).attr('src'));
		}
	});

}

/*

		SUB MENU
	
*/

function load_sub_menu(url)
{
	$("#sub_menu").load(url);
}

function show_sub_menu()
{
	$("#sub_menu").show("slide", { direction: "up" }, 'fast');
}

function hide_sub_menu()
{

	// Clear previous selection
	clear_sub_menu_id();

	// Hide sub menu
	$("#sub_menu").hide("slide", { direction: "up" }, 'fast');
	
}

function set_sub_menu_id(id)
{
	if (id != sub_menu_id)
	{

		clear_sub_menu_id();

		sub_menu_id = id;
		
		// Apply selected item class
		$('#' + sub_menu_id).addClass('sub-menu-item-selected', 'fast');

		// Quietly remove highlight class
		$('#' + sub_menu_id).removeClass('sub-menu-item-highlight');

	}
}

function clear_sub_menu_id()
{
	
	if (sub_menu_id)
	{
		$('#' + sub_menu_id).removeClass('sub-menu-item-selected', 'fast');
	}
	
	sub_menu_id = null;
	
}

function add_sub_menu_listeners()
{

	$('.sub-menu-item').mouseover(function()
	{ 
		if ($(this).attr('id') !== sub_menu_id)
		{
			$(this).addClass('sub-menu-item-highlight', 'fast');
		}
	});
	
	$('.sub-menu-item').mouseout(function()
	{ 
		if ($(this).attr('id') !== sub_menu_id)
		{
			$(this).removeClass('sub-menu-item-highlight', 'fast');
		}
	});
	
	$('.sub-menu-item').click(function()
	{ 
		
		if($(this).attr('src'))
		{
			navigate_to($(this).attr('src'));
		}

	});
	
}