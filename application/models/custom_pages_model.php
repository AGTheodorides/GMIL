<?php

class Custom_pages_model extends CI_Model 
{
 
	public function get_custom_page($custom_page_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $custom_page_id);
		
		$query = $this->db->get('custom_pages');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function update_custom_page($custom_page_id, $body)
	{
		
		$data = array(
			'body' => $body
		);
	
		$this->db->where('id', $custom_page_id);
		$this->db->update('custom_pages', $data); 
	
	}
	
}
