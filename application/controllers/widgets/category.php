<?php

class Category extends MY_Controller 
{
	
	public function index()
	{

		// Load models
		$this->load->model('genres_model');
		$this->load->model('categories_model');

		// Load parameters
		$element_id = $this->input->get('element_id');
		$input_name = $this->input->get('input_name');
		$genre_element_id = $this->input->get('genre_element_id');
		$genre_id = $this->input->get('genre_id');
		$category_id = $this->input->get('category_id');
		
		if ($genre_id != "")
		{		
			$genre = $this->genres_model->get_genre($genre_id);
		}
		else
		{
			$genre = $this->genres_model->get_genres()->row();
		}
		
		if ($category_id != "")
		{
			$category = $this->categories_model->get_category($category_id);
		}
		else
		{
			$category = $this->categories_model->get_categories_by_genre($genre->id)->row();
		}

		// Pass data
		$this->data['genre'] = $genre;
		$this->data['category'] = $category;
		$this->data['categories'] = $this->categories_model->get_categories_by_genre($genre->id);
		$this->data['element_id'] = $element_id;
		$this->data['input_name'] = $input_name;
		$this->data['genre_element_id'] = $genre_element_id;
		
		// Load view content
		$this->load->view('widgets/category', $this->data);
	
	}
	
}