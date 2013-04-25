<?php

class Dashboard extends MY_Controller 
{

	function overview()
	{
		
		// Set menus
		$this->data['recently_updated_limit'] = $this->get('overview_recently_updated_limit');
		$this->data['recently_created_limit'] = $this->get('overview_recently_created_limit');
		$this->data['followed_limit'] = $this->get('overview_followed_limit');
		$this->data['featured_limit'] = $this->get('overview_featured_limit');
		$this->data['my_icons_limit'] = $this->get('overview_my_icons_limit');
		$this->data['main_menu_id'] = 'dashboard';
		$this->data['sub_menu_id'] = 'overview';
		
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('dashboard/sub_menu', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('dashboard/overview', $this->data);
		$this->load->view('footer', $this->data);
		
	}

	function view($part)
	{
		
		// Set menus
		$this->data['main_menu_id'] = 'dashboard';
		$this->data['sub_menu_id'] = $part;
		
		// Pass data
		$this->data['part'] = $part;
		
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('dashboard/sub_menu', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('dashboard/view', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	/* PARTS */
	
	function alphabetical_order()
	{
	
		// Read post
		$limit = $this->input->post('limit');
	
		// Load models
		$this->load->model('icons_model');

		// Pass data
		$this->data['title'] = 'alphabetical order';
		$this->data['icons'] = $this->icons_model->get_icons_ordered('title_text', 'asc');
		$this->data['limit'] = $limit;
		
		// Load view content
		$this->load->view('dashboard/icons', $this->data);
		
	}

	function featured()
	{
	
		// Read post
		$limit = $this->input->post('limit');
	
		// Load models
		$this->load->model('icons_model');

		// Pass data
		$this->data['title'] = 'featured';
		$this->data['icons'] = $this->icons_model->get_featured_icons();
		$this->data['limit'] = $limit;
		
		// Load view content
		$this->load->view('dashboard/icons', $this->data);
		
	}

	function recently_updated()
	{
	
		// Read post
		$limit = $this->input->post('limit');
	
		// Load models
		$this->load->model('icons_model');

		// Pass data
		$this->data['title'] = 'recently updated';
		$this->data['icons'] = $this->icons_model->get_icons_ordered('update_date', 'desc');
		$this->data['limit'] = $limit;
		
		// Load view content
		$this->load->view('dashboard/icons', $this->data);
		
	}

	function recently_created()
	{
	
		// Read post
		$limit = $this->input->post('limit');
	
		// Load models
		$this->load->model('icons_model');

		// Pass data
		$this->data['title'] = 'recently created';
		$this->data['icons'] = $this->icons_model->get_icons_ordered('creation_date', 'desc');	// Pass ordered icons query
		$this->data['limit'] = $limit;
		
		// Load view content
		$this->load->view('dashboard/icons', $this->data);
		
	}
	
	function followed()
	{
	
		// Read post
		$limit = $this->input->post('limit');
	
		// Load models
		$this->load->model('icons_model');

		// Pass data
		$this->data['title'] = 'followed';
		$this->data['icons'] = $this->icons_model->get_followed_icons($this->data['me']->id);
		$this->data['limit'] = $limit;
		
		// Load view content
		$this->load->view('dashboard/icons', $this->data);
		
	}

	function my_icons()
	{
	
		// Read post
		$limit = $this->input->post('limit');
	
		// Load models
		$this->load->model('icons_model');

		// Pass data
		$this->data['title'] = 'my icons';
		$this->data['icons'] = $this->icons_model->get_user_icons($this->data['me']->id);
		$this->data['limit'] = $limit;
		
		// Load view content
		$this->load->view('dashboard/icons', $this->data);
		
	}

}
