<?php

class Temp_images_model extends CI_Model 
{
 
	public function get_temp_images()
	{
		
		$this->db->select('*');
		
		return $this->db->get('temp_images');
	
	}
	
	public function get_temp_image_for_ip_address($ip_address)
	{
	
		$this->db->select('*');
		$this->db->where('ip_address', $ip_address);
		
		$query = $this->db->get('temp_images');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}

	public function get_temp_image($temp_image_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $temp_image_id);
		
		$query = $this->db->get('temp_images');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function add_temp_image($url, $ip_address)
	{
		
		$data = array(
			'url' => $url,
			'ip_address' => $ip_address,
			'upload_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert('temp_images', $data);
		
		// Return new temp_images id
		return $this->db->insert_id();
	
	}
	
	public function update_temp_image($temp_image_id, $url)
	{
		
		$data = array(
			'url' => $url,
			'upload_date' => date("Y-m-d H:i:s")
		);

		$this->db->where('id', $temp_image_id);
		$this->db->update('temp_images', $data);
		
	}

	public function delete_temp_image($temp_image_id)
	{
		
		$this->db->where('id', $temp_image_id);
		$this->db->delete('temp_images'); 
		
		// No related records.
	
	}
	
}
