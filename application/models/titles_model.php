<?php

class Titles_model extends CI_Model 
{
 
	public function get_titles($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		
		return $this->db->get('v_icon_titles');
	
	}
	
	public function get_title($title_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $title_id);
		
		$query = $this->db->get('titles');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}

	public function add_title($icon_id, $text)
	{
	
		$data = array(
			'icon_id' => $icon_id,
			'text' => $text
		);

		$this->db->insert('titles', $data);
	
		return $this->db->insert_id();
		
	}
	
	public function delete_title($title_id)
	{
		
		$this->db->where('id', $title_id);
		$this->db->delete('titles'); 
		
		// Delete related votes.
	
	}
	
	public function update_title($title_id, $text)
	{
		
		$data = array(
			'text' => $text
		);
	
		$this->db->where('id', $title_id);
		$this->db->update('titles', $data); 
	
	}

}