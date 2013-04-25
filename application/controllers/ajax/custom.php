<?php

/**
 * This controller is responsible for handling custom resources. 
 */
class Custom extends MY_Controller 
{

	public function update_custom_page()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$custom_page_id = $this->input->post('custom_page_id');
			$body = $this->input->post('body');
				
			// Load models
			$this->load->model('custom_pages_model');
			
			// Add country
			$country_id = $this->custom_pages_model->update_custom_page($custom_page_id, $body);

			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
}