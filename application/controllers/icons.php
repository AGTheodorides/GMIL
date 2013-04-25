<?php 

class Icons extends MY_Controller 
{

	public function edit($icon_id)
	{
		
		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('icons/edit', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	public function add()
	{

		// Set menus
		$this->data['main_menu_id'] = 'submit_icon';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('icons/add', $this->data);
		$this->load->view('footer', $this->data);
	
	}

	public function original()
	{
	
		// Read post
		$icon_id = $this->input->get_post('icon_id');

		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['original_data'] = $this->icons_model->get_icon_original_fields($icon_id);

		// Load view content
		$this->load->view('icons/parts/original', $this->data);
	
	}
	
	public function finalized()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['final_data'] = $this->icons_model->get_icon_final_fields($icon_id);

		// Load view content
		$this->load->view('icons/parts/final', $this->data);
	
	}
	
	public function images()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['icon_images'] = $this->icons_model->get_icon_images($icon_id);
		$this->data['comments'] = $this->icons_model->get_icon_field_comments($icon_id, 3);

		// Load view content
		$this->load->view('icons/parts/images', $this->data);
	
	}

	public function titles()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['icon_titles'] = $this->icons_model->get_icon_titles($icon_id);
		$this->data['comments'] = $this->icons_model->get_icon_field_comments($icon_id, 1);

		// Load view content
		$this->load->view('icons/parts/titles', $this->data);
	
	}

	public function definitions()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['icon_definitions'] = $this->icons_model->get_icon_definitions($icon_id);
		$this->data['comments'] = $this->icons_model->get_icon_field_comments($icon_id, 2);

		// Load view content
		$this->load->view('icons/parts/definitions', $this->data);
	
	}
		
	public function category_entries()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['icon_category_entries'] = $this->icons_model->get_icon_category_entries($icon_id);
		$this->data['comments'] = $this->icons_model->get_icon_field_comments($icon_id, 4);

		// Load view content
		$this->load->view('icons/parts/categories', $this->data);
	
	}
	
	public function theme_entries()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['icon_theme_entries'] = $this->icons_model->get_icon_theme_entries($icon_id);
		$this->data['comments'] = $this->icons_model->get_icon_field_comments($icon_id, 5);

		// Load view content
		$this->load->view('icons/parts/themes', $this->data);
	
	}

	public function comments()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');
		$field_type = $this->input->get('field_type');
		
		// Load models
		$this->load->model('icons_model');
		$this->load->model('users_model');
		
		// Pass data
		$this->data['field_type'] = $field_type;
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['comments'] = $this->icons_model->get_icon_field_comments($icon_id, $field_type);

		// Load view content
		$this->load->view('icons/parts/comments', $this->data);
	
	}
	
	public function controls()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		$this->load->model('users_model');
		$this->load->model('flags_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['flag'] = $this->flags_model->find_flag(Array('user_id'=>$this->me->id,'icon_id'=>$icon_id));
		$this->data['creator'] = $this->users_model->get_user($this->data['icon']->creator_id);
		$this->data['icon_is_followed'] = $this->icons_model->is_icon_followed($icon_id, $this->data['me']->id);

		// Load view content
		$this->load->view('icons/parts/controls', $this->data);
	
	}
	
	public function properties()
	{
	
		// Read post
		$icon_id = $this->input->get('icon_id');

		// Load models
		$this->load->model('icons_model');
		$this->load->model('users_model');
		
		// Pass data
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['creator'] = $this->users_model->get_user($this->data['icon']->creator_id);
		$this->data['icon_is_followed'] = $this->icons_model->is_icon_followed($icon_id, $this->data['me']->id);

		// Load view content
		$this->load->view('icons/parts/properties', $this->data);
	
	}

	public function voter()
	{

		// Read post
		$icon_id = $this->input->get('icon_id');
		$field_type = $this->input->get('field_type');
		$field_id = $this->input->get('field_id');
	
		// Load models
		$this->load->model('icons_model');
		$this->load->model('votes_model');

		$vote = $this->votes_model->get_vote($this->me->id, $icon_id, $field_type, $field_id);
	
		if (isset($vote))
		{
			$has_voted = 1;
		}
		else
		{
			$has_voted = 0;
		}	
	
		// Pass data
		$this->data['has_voted'] = $has_voted;
		$this->data['icon'] = $this->icons_model->get_icon($icon_id);
		$this->data['votes'] = $this->votes_model->get_vote_details($icon_id, $field_type, $field_id);
		
		// Load view content
		$this->load->view('icons/parts/voter', $this->data);
	
	}
	
}
