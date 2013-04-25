<?php

class Definitions_model extends CI_Model 
{
 
	public function get_definitions($icon_id)
	{
		
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		
		return $this->db->get('v_icon_definitions');
	
	}
	
	public function get_definition($definition_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $definition_id);
		
		$query = $this->db->get('definitions');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}

	public function add_definition($icon_id, $text)
	{
	
		$data = array(
			'icon_id' => $icon_id,
			'text' => $text
		);

		$this->db->insert('definitions', $data);
	
		return $this->db->insert_id();
		
	}
	
	public function delete_definition($definition_id)
	{
		
		$this->db->where('id', $definition_id);
		$this->db->delete('definitions'); 
		
		// Delete related votes.
	
	}
	
	public function update_definition($definition_id, $text)
	{
		
		$data = array(
			'text' => $text
		);
	
		$this->db->where('id', $definition_id);
		$this->db->update('definitions', $data); 
	
	}
	
}
