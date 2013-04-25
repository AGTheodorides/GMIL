<?php

class Categories_model extends CI_Model 
{
 
	public function get_categories()
	{
	
		$this->db->select('*');
		$this->db->order_by('text');
		
		return $this->db->get('categories');
	
	}
	
	public function get_categories_by_genre($genre_id)
	{
	
		$this->db->select('*');
		$this->db->where('genre_id', $genre_id);
		$this->db->order_by('text');

		return $this->db->get('categories');
	
	}
	
	public function get_category($category_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $category_id);
		
		$query = $this->db->get('categories');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function add_category($genre_id, $text)
	{
	
		$data = array(
			'genre_id' => $genre_id,
			'text' => $text
		);

		$this->db->insert('categories', $data);
	
		return $this->db->insert_id();
		
	}
	
	public function delete_category($category_id)
	{

		$this->db->where('id', $category_id);
		$this->db->delete('categories'); 
		
		// Delete related category entries and votes.

	}
	
	public function get_category_entries($icon_id)
	{
		
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		
		$query = $this->db->get('category_entries');
		
	}
	
	public function add_category_entry($icon_id, $category_id)
	{
				
		$data = array(
			'icon_id' => $icon_id,
			'category_id' => $category_id
		);

		$this->db->insert('category_entries', $data);
	
		return $this->db->insert_id();
		
	}
	
	public function delete_category_entry($category_entry_id)
	{
		
		$this->db->where('id', $category_entry_id);
		$this->db->delete('category_entries'); 
		
		// Delete related votes.
	
	}
	
	public function update_category_entry($category_entry_id, $category_id)
	{
		
		$data = array(
			'category_id' => $category_id
		);
	
		$this->db->where('id', $category_entry_id);
		$this->db->update('category_entries', $data); 
	
	}
	
}