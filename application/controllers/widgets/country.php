<?php

class Country extends MY_Controller 
{
	
	public function index()
	{

		// Load models
		$this->load->model('countries_model');
		
		// Load parameters
		$element_id = $this->input->get('element_id');
		$input_name = $this->input->get('input_name');
		$country_id = $this->input->get('country_id');

		if ($country_id != "")
		{
			$country = $this->countries_model->get_country($country_id);
		}
		else
		{
			$country = $this->countries_model->get_countries()->row();
		}
		
		// Pass data
		$this->data['country'] = $country;
		$this->data['countries'] = $this->countries_model->get_countries();
		$this->data['element_id'] = $element_id;
		$this->data['input_name'] = $input_name;
		
		// Load view content
		$this->load->view('widgets/country', $this->data);
	
	}
	
}