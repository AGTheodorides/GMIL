<?php

class Genres_model extends CI_Model 
{
 
	public function get_genres()
	{
	
		$this->db->select('*');
		$this->db->order_by('text');
		
		return $this->db->get('genres');
	
	}
	
	public function get_genre($genre_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $genre_id);
		
		$query = $this->db->get('genres');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function add_genre($text)
	{
		
		$data = array(
			'text' => $text
		);

		$this->db->insert('genres', $data);
		
		return $this->db->insert_id();
	
	}
	
	public function delete_genre($genre_id)
	{

		$this->db->where('id', $genre_id);
		$this->db->delete('genres'); 
		
		// Delete related categories, category entries and votes.
		
	}

}
