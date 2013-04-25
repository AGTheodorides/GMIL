<?php 

class Terms extends MY_Controller 
{

	public function index() 
	{
	
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('terms/main', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
}
