<?php

class Themes_model extends CI_Model 
{
 
	public function get_themes()
	{
		
		$this->db->select('*');
		$this->db->order_by('text');
		
		return $this->db->get('themes');
	
	}
	
	public function get_theme($theme_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $theme_id);
		
		$query = $this->db->get('themes');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function add_theme($text)
	{
		
		$data = array(
			'text' => $text
		);

		$this->db->insert('themes', $data);
	
		return $this->db->insert_id();
		
	}
	
	public function delete_theme($theme_id)
	{
		
		$this->db->where('id', $theme_id);
		$this->db->delete('themes'); 
		
		// Delete related theme entries and votes.
	
	}
	
	public function get_theme_entries($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		
		$query = $this->db->get('theme_entries');
		
	}
	
	public function add_theme_entry($icon_id, $theme_id)
	{
			
		$data = array(
			'icon_id' => $icon_id,
			'theme_id' => $theme_id
		);

		$this->db->insert('theme_entries', $data);
	
		return $this->db->insert_id();
		
	}

	public function delete_theme_entry($theme_entry_id)
	{
		
		$this->db->where('id', $theme_entry_id);
		$this->db->delete('theme_entries'); 
		
		// Delete related votes.
	
	}

	public function update_theme_entry($theme_entry_id, $theme_id)
	{
		
		$data = array(
			'theme_id' => $theme_id
		);
	
		$this->db->where('id', $theme_entry_id);
		$this->db->update('theme_entries', $data); 
	
	}
	
}
