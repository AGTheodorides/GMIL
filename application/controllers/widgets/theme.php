<?php

class Theme extends MY_Controller 
{
	
	// Loads the page with default content
	public function index()
	{

		// Load models
		$this->load->model('themes_model');

		// Load parameters
		$element_id = $this->input->get('element_id');
		$input_name = $this->input->get('input_name');
		$theme_id = $this->input->get('theme_id');

		if ($theme_id != "")
		{
			$theme = $this->themes_model->get_theme($theme_id);
		}
		else
		{
			$theme = $this->themes_model->get_themes()->row();
		}
		
		// Pass data
		$this->data['theme'] = $theme;
		$this->data['themes'] = $this->themes_model->get_themes();
		$this->data['element_id'] = $element_id;
		$this->data['input_name'] = $input_name;
		
		// Load view content
		$this->load->view('widgets/theme', $this->data);
	
	}
	
}