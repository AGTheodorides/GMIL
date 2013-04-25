<?php 

class Faq extends MY_Controller 
{

	public function index() 
	{
	
		// Set menus
		$this->data['main_menu_id'] = 'faq';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('faq/main', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
}
