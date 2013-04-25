<?php

class Images_model extends CI_Model 
{
 
	public function get_images($icon_id)
	{
		
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		
		return $this->db->get('v_icon_images');
	
	}
	
	public function get_image($image_id)
	{
		
		$this->db->select('*');
		$this->db->where('id', $image_id);
		
		$query = $this->db->get('images');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}

	public function add_image($icon_id, $url)
	{
		
		$data = array(
			'icon_id' => $icon_id,
			'url' => $url
		);

		$this->db->insert('images', $data);
	
		return $this->db->insert_id();
		
	}
	
	public function update_image($image_id, $url)
	{
		
		$data = array(
			'url' => $url
		);
		
		$this->db->where('id', $image_id);
		$this->db->update('images', $data);
	
	}
	
	public function delete_image($image_id)
	{
	
		$this->db->where('id', $image_id);
		$this->db->delete('images'); 
		
		// Delete related votes.
	
	}

}
