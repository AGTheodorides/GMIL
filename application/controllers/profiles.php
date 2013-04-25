<?php 

class Profiles extends MY_Controller 
{

	public function add()
	{
		
		// Set menus
		if ($this->data['me']->id == 1)
		{
			$this->data['main_menu_id'] = 'my_account';
		}
		
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('profiles/add', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	public function verify($verify_id)
	{
	
		$this->load->model('users_model');
		
		// Get user
		$user = $this->users_model->find_user(Array('verify_id'=>$verify_id));
		
		if ($user)
		{
			$this->users_model->update_user_data($user->id, Array(
				'is_email_verified' => 1,
				'verify_id'=>null,
				'verify_expires'=>null
			));
			$this->session->set_userdata('info', $this->get("info_user_email_verification"));
		}
		else
		{
			$this->session->set_userdata('error', 'invalid or expired verification request');
		}
	
		redirect('dashboard/overview');
		
	}
	
	public function edit($user_id = null)
	{
	
		if (!$user_id)
		{
			$user_id = $this->data['me']->id;
		}
	
		// Set menus
		if ($user_id == $this->data['me']->id)
		{
			$this->data['main_menu_id'] = 'my_account';
		}
		
		// Load models
		$this->load->model('users_model');
		
		// Pass data
		$this->data['user'] = $this->users_model->get_user($user_id);
		
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('profiles/edit', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	public function view($user_id)
	{
	
		// Load models
		$this->load->model('users_model');
		
		// Pass data
		$this->data['user'] = $this->users_model->get_user($user_id);
		
		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		$this->load->view('main/edit_profile_view', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	public function password_reset($reset_id = null)
	{
		$this->load->view('header', $this->data);
		$this->load->view('infoline', $this->data);
		if ($reset_id)
		{
			// Verify reset id
			$this->data['reset_id'] = $reset_id;
			$this->load->view('profiles/password_reset', $this->data);
		}
		else
		{
			$this->load->view('profiles/password_reset_request', $this->data);
		}
		$this->load->view('footer', $this->data);
	}
	
	public function login()
	{
	
		// Load view content
		$this->load->view('profiles/login', $this->data);
	
	}
	
}
