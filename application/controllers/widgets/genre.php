<?php

class Genre extends MY_Controller 
{
	
	// Loads the page with default content
	public function index()
	{

		// Load models
		$this->load->model('genres_model');
		
		// Load parameters
		$element_id = $this->input->get('element_id');
		$input_name = $this->input->get('input_name');
		$genre_id = $this->input->get('genre_id');

		if ($genre_id != "")
		{
			$genre = $this->genres_model->get_genre($genre_id);
		}
		else
		{
			$genre = $this->genres_model->get_genres()->row();
		}

		// Pass data
		$this->data['genre'] = $genre;
		$this->data['genres'] = $this->genres_model->get_genres();
		$this->data['element_id'] = $element_id;
		$this->data['input_name'] = $input_name;
		
		// Load view content
		$this->load->view('widgets/genre', $this->data);
	
	}
	
}