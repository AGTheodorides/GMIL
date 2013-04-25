<?php

class Image extends MY_Controller 
{
	
	public function index()
	{

		// Load parameters
		$element_id = $this->input->get_post('element_id');
		$input_name = $this->input->get_post('input_name');
		$image_url = $this->input->get_post('image_url');

		// Pass data
		$this->data['element_id'] = $element_id;
		$this->data['input_name'] = $input_name;
		
		if ($image_url != "")
		{
			$this->data['image_url'] = $image_url;
		}
		else
		{
			$this->data['image_url'] = null;
		}
		
		// Load view content
		$this->load->view('/widgets/image', $this->data);
	
	}
	
	private function p_create_temp_image_copy($original_image_url)
	{

		// Get remote ip address
		$ip_address = $_SERVER['REMOTE_ADDR'];
		
		// Calculate url
		$temp_image_url = 'temp/'.str_replace('.', '_', $ip_address).'.'.pathinfo($original_image_url, PATHINFO_EXTENSION);
		
		// Calculate real paths
		$real_original_image_url = realpath(APPPATH.'../images/'.$original_image_url);
		$real_temp_image_url = realpath(APPPATH.'../images').'/'.$temp_image_url;
		
		if(file_exists($real_original_image_url) && isset($real_temp_image_url))
		{
			
			// Copy image
			copy($real_original_image_url, $real_temp_image_url);
			
		}
		else
		{
			return null;
		}
		
		return $temp_image_url;
	
	}
	
}