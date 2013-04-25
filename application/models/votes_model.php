<?php

class Votes_model extends CI_Model 
{

	public function get_vote($user_id, $icon_id, $field_type, $field_id)
	{
		
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->where('icon_id', $icon_id);
		$this->db->where('field_type', $field_type);
		$this->db->where('field_id', $field_id);
		
		$query= $this->db->get('votes');	
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
		
	}

	public function get_vote_details($icon_id, $field_type, $field_id)
	{
		
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->where('field_type', $field_type);
		$this->db->where('field_id', $field_id);
		
		return $this->db->get('v_vote_details')->row();
	
	}
 
	// Adds a vote
	// Field types:
	//	Title		1
	//	Definition	2
	//	Image		3
	//	Category	4
	//	Theme		5
	public function add_vote($user_id, $icon_id, $field_type, $field_id, $value)
	{
	
		$data = array(
			'user_id' => $user_id,
			'icon_id' => $icon_id,
			'field_type' => $field_type,
			'field_id' => $field_id,
			'value' => $value
		);

		$this->db->insert('votes', $data); 	
		
		return $this->db->insert_id();
		
	}
 
	// Deletes the vote
	public function delete_vote($vote_id)
	{
		
		$this->db->where('id', $vote_id);
		$this->db->delete('votes'); 
		
		// No related records.
		
	}

	// Deletes all votes for the field
	public function delete_field_votes($icon_id, $field_type, $field_id)
	{
		
		$this->db->where('icon_id', $icon_id);
		$this->db->where('filed_type', $field_type);
		$this->db->where('field_id', $field_id);
		$this->db->delete('votes'); 
		
		// No related records.
		
	}
	
}
