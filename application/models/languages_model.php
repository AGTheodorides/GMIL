<?php

class Languages_model extends CI_Model 
{
 
	public function get_languages()
	{
	
		$this->db->select('*');
		$this->db->order_by('text');
		
		return $this->db->get('languages');
	
	}
	
	public function get_language($language_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $language_id);
		
		$query = $this->db->get('languages');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function add_language($text)
	{
		
		$data = array(
			'text' => $text
		);

		$this->db->insert('languages', $data);
	
		return $this->db->insert_id();
	
	}
	
	public function update_language($language_id, $text)
	{
		
		$data = array(
			'text' => $text
		);

		$this->db->where('id', $language_id);
		$this->db->update('languages', $data);
	
	}

	public function delete_language($language_id)
	{

		$this->db->where('id', $language_id);
		$this->db->delete('languages'); 
		
		// Update related users' language.
		
	}

}
