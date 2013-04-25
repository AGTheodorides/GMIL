<?php 

class MY_Controller extends CI_Controller 
{
	
	// Get current user record
	private function get_user()
	{
		
		// Load models
		$this->load->model('users_model');

		// Check for current authorization
		if ($this->session->userdata('current_user_id'))
		{
			$current_user_id = $this->session->userdata('current_user_id');
		}
		else
		{
			$current_user_id = 1;
			$this->session->set_userdata('current_user_id', $current_user_id);
		}
		
		// If guest, check for cookie
		if ($current_user_id == 1)
		{

			$this->load->helper('cookie');
			
			$auth_cookie = $this->input->cookie('gmit_auth_cookie');
			
			if ($auth_cookie)
			{
				
				// Attempt to get user from cookie id
				$user = $this->users_model->find_user(Array('auth_cookie_id' => $auth_cookie));
				
				if ($user)
				{
					$current_user_id = $user->id;
				}
				
			}
			
		}
		
		// Get user record			
		$me = $this->users_model->get_user($current_user_id);
		
		if (!$me)
		{
			// Oops, unable to find record
			$this->session->set_userdata('current_user_id', 1);
			$me = $this->users_model->get_user(1);
		}
		
		if ($me->is_banned)
		{
			// Oops, user got banned
			$this->session->set_userdata('current_user_id', 1);
			$me = $this->users_model->get_user(1);
			$this->session->set_userdata('error', $this->get("info_user_ban"));
		}

		return $me;
			
	}
	
	function get($name)
	{
		return $this->settings_model->get_setting($name);
	}
	
	function set($name, $value)
	{
		return $this->settings_model->set_setting($name, $value);
	}
	
	// Constructor
	function __construct()
	{

		parent::__construct();

		$this->me = $this->get_user();
		$this->data['me'] = $this->me;
		$this->data['main_menu_id'] = null;
		$this->data['sub_menu_id'] = null;
		
		$this->load->model('settings_model');
		
		// Disable error reporting
		error_reporting(-1);

	}
	
}
