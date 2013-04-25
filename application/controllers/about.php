<?php 

class About extends MY_Controller 
{

	public function index() 
	{
	
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('about/main', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
}
