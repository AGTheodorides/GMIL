<?php

class Countries_model extends CI_Model 
{
 
	public function get_countries()
	{
	
		$this->db->select('*');
		$this->db->order_by('text');
		
		return $this->db->get('countries');
	
	}
	
	public function get_country($country_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $country_id);
		
		$query = $this->db->get('countries');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	public function add_country($text)
	{
		
		$data = array(
			'text' => $text
		);

		$this->db->insert('countries', $data);
	
		return $this->db->insert_id();
	
	}
	
	public function update_country($country_id, $text)
	{
		
		$data = array(
			'text' => $text
		);

		$this->db->where('id', $country_id);
		$this->db->update('countries', $data);
	
	}

	public function delete_country($country_id)
	{

		$this->db->where('id', $country_id);
		$this->db->delete('countries'); 
		
		// Update related users' country.
		
	}

}
