<?php

class Settings_model extends CI_Model 
{
 
	public function get_setting($name)
	{
	
		$this->db->select('*');
		$this->db->where('name', $name);
		
		$query = $this->db->get('settings');
		
		if ($query->num_rows() > 0)
		{
			return $query->row()->value;
		}
		else
		{
			return null;
		}
	
	}
	
	public function set_setting($name, $value)
	{
		
		// Set update date
		$data = array("value" => $value);
		
		$this->db->where('name', $name);
		$this->db->update('settings', $data);
	
	}
	
}
