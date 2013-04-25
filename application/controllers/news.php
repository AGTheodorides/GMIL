<?php 

class News extends MY_Controller 
{

	public function index() 
	{
	
		// Set menus
		$this->data['main_menu_id'] = 'news';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('news/main', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
}
