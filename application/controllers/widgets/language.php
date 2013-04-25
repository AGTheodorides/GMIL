<?php

class Language extends MY_Controller 
{
	
	public function index()
	{

		// Load models
		$this->load->model('languages_model');
		
		// Load parameters
		$element_id = $this->input->get('element_id');
		$input_name = $this->input->get('input_name');
		$language_id = $this->input->get('language_id');

		if ($language_id != "")
		{
			$language = $this->languages_model->get_language($language_id);
		}
		else
		{
			$language = $this->languages_model->get_languages()->row();
		}
		
		// Pass data
		$this->data['language'] = $language;
		$this->data['languages'] = $this->languages_model->get_languages();
		$this->data['element_id'] = $element_id;
		$this->data['input_name'] = $input_name;
		
		// Load view content
		$this->load->view('widgets/language', $this->data);
	
	}
	
}