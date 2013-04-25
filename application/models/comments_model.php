<?php

class Comments_model extends CI_Model 
{
 
	// Gets the icon record
	public function get_comment($comment_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $comment_id);
		
		return $this->db->get('comments')->row();
	
	}

	// Gets all icon records with full details
	public function get_comments()
	{
	
		$this->db->select('*');
		
		return $this->db->get('comments');
	
	}

	// Adds an icon and returns the new id
	public function add_comment($icon_id, $field_type, $creator_id, $text)
	{
	
		$data = array(
			'icon_id' => $icon_id,
			'field_type' => $field_type,
			'creator_id' => $creator_id,
			'creation_date' => date("Y-m-d H:i:s"),
			'text' => $text
		);

		$this->db->insert('comments', $data); 
		
		return $this->db->insert_id();
	
	}
 
	// Delete the icon
	public function delete_comment($comment_id)
	{
		
		$this->db->where('id', $comment_id);
		$this->db->delete('comments'); 
		
		// Delete related titles, definitions, images, category entries, theme entries and votes.
		
	}

	public function update_comment($comment_id, $text)
	{
		
		$data = array(
			'text' => $text
		);
	
		$this->db->where('id', $comment_id);
		$this->db->update('comments', $data); 
	
	}
	
}
