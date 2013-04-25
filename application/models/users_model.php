<?php

class Users_model extends CI_Model 
{

	public function find_users($args)
	{
	
		$this->db->select('*');
		$this->db->where($args);
		$this->db->order_by('username');
		
		return $this->db->get('users');
	
	}

	public function get_users()
	{
	
		$this->db->select('*');
		$this->db->order_by('username');
		
		return $this->db->get('users');
	
	}
	
	public function get_users_by_level($level)
	{
	
		$this->db->select('*');
		$this->db->where('level', $level);
		$this->db->order_by('username');
		
		return $this->db->get('users');
	
	}
	
	public function get_user($user_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $user_id);
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function find_user($args)
	{
	
		$this->db->select('*');
		$this->db->where($args);
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function get_user_by_username($username)
	{
	
		$this->db->select('*');
		$this->db->where('username', $username);
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}

	public function get_user_by_email($email)
	{
	
		$this->db->select('*');
		$this->db->where('email', $email);
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function get_user_by_credentials($username, $password)
	{
	
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function get_allowed_emails()
	{
	
		$this->db->select('email');
		$this->db->where('allow_email', 1);
		
		return $this->db->get('users');
		
	}
	
	public function add_user($username, $password, $email, $allow_email, $country_id, $language_id)
	{
		
		$data = array(
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'allow_email' => $allow_email,
			'level' => 1,
			'country_id' => $country_id,
			'language_id' => $language_id
		);

		$this->db->insert('users', $data);
		
		return $this->db->insert_id();
	
	}
	
	public function update_user($user_id, $username, $email, $allow_email, $country_id, $language_id)
	{
		
		$data = array(
			'username' => $username,
			'email' => $email,
			'allow_email' => $allow_email,
			'country_id' => $country_id,
			'language_id' => $language_id
		);

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
	
	}
	
	public function update_user_image($user_id, $image_url)
	{
		
		$data = array(
			'image_url' => $image_url
		);

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
	
	}

	public function update_user_level($user_id, $level)
	{
			
		$data = array(
			'level' => $level,
		);

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
	
	}
	
	public function update_user_password($user_id, $password)
	{
		
		$data = array(
			'password' => $password,
		);

		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
	
	}

	public function update_user_data($user_id, $data)
	{
		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
	}
	
	public function delete_user($user_id)
	{

		$this->db->where('id', $user_id);
		$this->db->delete('users'); 
		
		// No related records.
		
	}
	
}
