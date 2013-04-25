<?php

class Flags_model extends CI_Model 
{

	public function find_flags($args)
	{
	
		$this->db->select('*');
		$this->db->where($args);
		
		return $this->db->get('flags');
	
	}
	
	public function get_flag($flag_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $flag_id);
		
		$query = $this->db->get('flags');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}

	public function find_flag($args)
	{
	
		$this->db->select('*');
		$this->db->where($args);
		
		$query = $this->db->get('flags');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function add_flag($data)
	{
		
		$this->db->insert('flags', $data);
		
		return $this->db->insert_id();
	
	}
	
	public function update_flag($flag_id, $data)
	{
		
		$this->db->where('id', $flag_id);
		$this->db->update('flags', $data);
		
		return $this->db->insert_id();
	
	}

	public function delete_flag($flag_id)
	{

		$this->db->where('id', $flag_id);
		$this->db->delete('flags'); 
		
		// No related records.
		
	}
	
}
