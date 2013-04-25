<?php

class Icons_model extends CI_Model 
{
 
	// Gets the icon record
	public function get_icon($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('id', $icon_id);
		
		return $this->db->get('v_icon_details')->row();
	
	}

	// Adds the original fields
	public function add_icon_original_fields($icon_id, $title_text, $definition_text, $url, $category_id, $theme_id)
	{

		$data = array(
			'icon_id' => $icon_id,
			'title_text' => $title_text,
			'definition_text' => $definition_text,
			'url' => $url,
			'category_id' => $category_id,
			'theme_id' => $theme_id,
		);
		
		$this->db->insert('icon_original_entries', $data); 
		
	}

	// Updates the original fields
	public function update_icon_original_fields($icon_id, $data)
	{

		$this->db->where('icon_id', $icon_id);
		$this->db->update('icon_original_entries', $data);	 
		
	}
	
	// Gets the original fields
	public function get_icon_original_fields($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		
		return $this->db->get('v_icon_original_details')->row();
	
	}
	
	// Adds the final fields
	public function add_icon_final_fields($icon_id, $title_text, $definition_text, $url, $category_id, $theme_id)
	{

		$data = array(
			'icon_id' => $icon_id,
			'title_text' => $title_text,
			'definition_text' => $definition_text,
			'url' => $url,
			'category_id' => $category_id,
			'theme_id' => $theme_id,
		);
		
		$this->db->insert('icon_final_entries', $data); 
		
	}

	// Updates the final fields
	public function update_icon_final_fields($icon_id, $data)
	{

		$this->db->where('icon_id', $icon_id);
		$this->db->update('icon_final_entries', $data);	 
		
	}
	
	// Gets the final fields
	public function get_icon_final_fields($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		
		return $this->db->get('v_icon_final_details')->row();
	
	}

	// Deletes the final fields
	public function delete_icon_final_fields($icon_id)
	{
	
		$this->db->where('icon_id', $icon_id);
		$this->db->delete('icon_final_entries'); 
	
	}
	
	// Gets all icon records with full details
	public function get_icons()
	{
	
		$this->db->select('*');
		
		return $this->db->get('v_icon_details');
	
	}

	// Gets all icon records with full details, ordered
	public function get_icons_ordered($field, $direction)
	{
	
		$this->db->select('*');
		$this->db->order_by($field, $direction);
		
		return $this->db->get('v_icon_details');
	
	}

	// Gets featured icons
	public function get_featured_icons()
	{
	
		$this->db->select('*');
		$this->db->where('featured', 1);
		$this->db->order_by('update_date', 'desc');
		
		return $this->db->get('v_icon_details');
	
	}

	// Gets user icons
	public function get_user_icons($user_id)
	{
	
		$this->db->select('*');
		$this->db->where('creator_id', $user_id);
		$this->db->order_by('update_date', 'desc');
		
		return $this->db->get('v_icon_details');
	
	}
	
	// Gets followed icons
	public function get_followed_icons($user_id)
	{
	
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->order_by('update_date', 'desc');
		
		return $this->db->get('v_followed_icons');
	
	}
	
	// Returns true if icon is followed
	public function is_icon_followed($icon_id, $user_id)
	{
	
		$this->db->select('*');
		$this->db->where('user_id', $user_id);
		$this->db->where('icon_id', $icon_id);
		
		if ($this->db->get('follow')->num_rows() > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	
	}

	// Adds a follow record
	public function follow_icon($icon_id, $user_id)
	{
	
		$data = array(
			'user_id' => $user_id,
			'icon_id' => $icon_id
		);
		
		$this->db->insert('follow', $data); 
		
		return $this->db->insert_id();
		
	}
	
	// Removes a follow record
	public function unfollow_icon($icon_id, $user_id)
	{
	
		$this->db->where('user_id', $user_id);
		$this->db->where('icon_id', $icon_id);
		$this->db->delete('follow'); 
	
	}
	
	// Gets the icon's titles
	public function get_icon_titles($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->order_by('vote_count', 'desc');
		
		return $this->db->get('v_icon_titles');
	
	}

	// Gets the icon's definitions
	public function get_icon_definitions($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->order_by('vote_count', 'desc');
		
		return $this->db->get('v_icon_definitions');
	
	}

	// Gets the icon's images
	public function get_icon_images($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->order_by('vote_count', 'desc');
		
		return $this->db->get('v_icon_images');
	
	}

	// Gets the icon's category entries
	public function get_icon_category_entries($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->order_by('vote_count', 'desc');
		
		return $this->db->get('v_icon_category_entries');
	
	}

	// Gets the icon's theme entries
	public function get_icon_theme_entries($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->order_by('vote_count', 'desc');
		
		return $this->db->get('v_icon_theme_entries');
	
	}
	
	// Gets the icon's comments
	public function get_icon_comments($icon_id)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->where('field_type', 0);
		$this->db->order_by('creation_date', 'desc');
		
		return $this->db->get('v_icon_comments');
	
	}
	
	// Gets the icon's comments
	public function get_icon_field_comments($icon_id, $field_type)
	{
	
		$this->db->select('*');
		$this->db->where('icon_id', $icon_id);
		$this->db->where('field_type', $field_type);
		$this->db->order_by('creation_date', 'desc');
		
		return $this->db->get('v_icon_comments');
	
	}
	
	// Adds an icon and returns the new id
	public function add_icon($creator_id)
	{
	
		$data = array(
			'creator_id' => $creator_id,
			'creation_date' => date("Y-m-d H:i:s"),
			'update_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert('icons', $data); 
		
		return $this->db->insert_id();
	
	}
 
	// Delete the icon
	public function delete_icon($icon_id)
	{
		
		$this->db->where('id', $icon_id);
		$this->db->delete('icons'); 
		
		// Delete related titles, definitions, images, category entries, theme entries and votes.
		
	}
	
	// Refresh update date for the icon
	public function update_icon($icon_id, $data)
	{
		
		if (isset($data))
		{
			$data['update_date'] = date("Y-m-d H:i:s");
		}
		else
		{
			$data = array(
				'update_date' => date("Y-m-d H:i:s")
			);
		}
	
		$this->db->where('id', $icon_id);
		$this->db->update('icons', $data); 
	
	}

	// Refresh update date for the icon
	public function update_icon_date($icon_id)
	{
		
		// Set update date
		$data = array("update_date" => date("Y-m-d H:i:s"));
		
		$this->db->where('id', $icon_id);
		$this->db->update('icons', $data);
	
	}

}
