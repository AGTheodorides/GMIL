<?php 

class Custom extends MY_Controller 
{

	public function page($custom_page_id)
	{
	
		// Load models
		$this->load->model('custom_pages_model');
		
		// Get page data
		$custom_page = $this->custom_pages_model->get_custom_page($custom_page_id);
		
		// Pass data
		$this->data['custom_page'] = $custom_page;
		
		// Load view content
		$this->load->view('custom/custom_page', $this->data);
	
	}
	
}
