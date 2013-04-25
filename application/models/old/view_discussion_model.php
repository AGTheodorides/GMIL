<?php

class View_discussion_model extends CI_Model {
// date("Y-m-d H:i:s")
    function __construct()
    {
        parent::__construct();
    }
	
	// Returns proposed elements (theme, category, etc) by discussion
	function get_element_by_disc($discussion_id, $element)
	{
		
		$this->db->select('*');
		$this->db->order_by('vote_count', 'DESC');
		$this->db->where('discussion_id', $discussion_id);
		
		return $this->db->get($element.'_by_disc'); 
		
	}
	
	// Returns all categories
	function get_categories()
	{
	
		$this->db->select('*');
		$this->db->order_by('category', 'ASC');
		
		return $this->db->get('category');
		
	}
	
	// Returns all themes
	function get_themes()
	{
	
		$this->db->select('*');
		$this->db->order_by('theme', 'ASC');
		
		return $this->db->get('theme'); 
		
	}
	
	// Creates a new proposed title and adds a vote for it
	function create_title($username, $discussion_id, $title)
	{
	
		$date = date("Y-m-d H:i:s");
	
		// Insert in title table
		$title_data = array(  
			'title' => $title,
			'title_creator' => $username,
			'creation_time' => $date,
			'discussion_id' => $discussion_id
		);
		
		$this->db->insert('title', $title_data); 
		 
		// Get newly assigned title id
		$title_id = $this->db->insert_id();
		
		// Vote for new title
		$this->vote($username, $discussion_id, 'title', $title_id);
		
		$this->mark_as_updated($discussion_id);
		
	}
	
	// Creates a new definition and adds a vote for it
	function create_definition($username, $discussion_id, $definition)
	{
	
		$date = date("Y-m-d H:i:s");
	
		// Insert in definition table
		$def_data = array(
			'definition' => $definition,
			'def_creator' => $username,
			'creation_time' => $date,
			'discussion_id' => $discussion_id
		);
		
		$this->db->insert('definition', $def_data); 
	
		// Get newly assigned definition id
		$def_id = $this->db->insert_id();
		
		// Vote for new title
		$this->vote($username, $discussion_id, 'definition', $def_id);
		
		$this->mark_as_updated($discussion_id);
		
	}
	
	// Creates a new icon and adds a vote for it
	function create_icon($username, $discussion_id, $url)
	{
	
		$date = date("Y-m-d H:i:s");
	
		// Insert in icon table
		$icon_data = array(  
			'url' => $url,
			'icon_creator' => $username,
			'creation_time' => $date,
			'discussion_id' => $discussion_id
		);
		
		$this->db->insert('icon', $icon_data); 
		 
		// Get newly assigned icon id
		$icon_id = $this->db->insert_id();
		
		// Vote for new icon
		$this->vote($username, $discussion_id, 'icon', $icon_id);
		
		$this->mark_as_updated($discussion_id);
		
	}
	
	// Flags a specific proposed element for a specific discussion
	function flag($username, $discussion_id, $element, $element_id)
	{
	
		// Check dicussion status
		if ($this->get_discussion_details($discussion_id)->status > 0)
		{
			
			// Discussion has been finalized
			return;
			
		}
	
		// Increase flag count
		$flag_data = array(  
			'username' => $username,
			'discussion_id' => $discussion_id,
			'element' => $element,
			'element_id' => $element_id
		);
		
		$this->db->insert('flags', $flag_data); 
		
		$this->mark_as_updated($discussion_id);
		
	}
	
	// Adds a vote for a specific proposed element for a specific discussion
	function vote($username, $discussion_id, $element, $element_id)
	{
	
		switch ($element) {
			case "title":
				$this->vote_title($username, $discussion_id, $element_id);
				break;
			case "definition":
				$this->vote_definition($username, $discussion_id, $element_id);
				break;
			case "icon":
				$this->vote_icon($username, $discussion_id, $element_id);
				break;
			case "category":
				$this->vote_category($username, $discussion_id, $element_id);
				break;
			case "theme":
				$this->vote_theme($username, $discussion_id, $element_id);
				break;
		}
		
		$this->mark_as_updated($discussion_id);
		
	}
	
	// Insert title vote
	private function vote_title($username, $discussion_id, $title_id)
	{

		$title_vote_data = array(  
			'title_id' => $title_id,
			'username' => $username,
			'vote' => '1'
		);
		
		$this->db->insert('title_vote', $title_vote_data); 
		
	}
	
	// Insert definition vote
	private function vote_definition($username, $discussion_id, $definition_id)
	{
	
		$def_vote_data = array(  
			'def_id' => $definition_id,
			'username' => $username,
			'vote' => '1'
		);
		
		$this->db->insert('def_vote', $def_vote_data); 
	
	}
	
	// Insert icon vote
	private function vote_icon($username, $discussion_id, $icon_id)
	{
	
		$icon_vote_data = array(  
			'icon_id' => $icon_id,
			'username' => $username,
			'vote' => '1'
		);
		
		$this->db->insert('icon_vote', $icon_vote_data); 
		
	}
	
	// Insert category vote for user 
	private function vote_category($username, $discussion_id, $category_id)
	{
	
		$cat_vote_data = array (
			'vote' => '1',
			'cat_id' => $category_id,
			'username' => $username,
			'disc_id' => $discussion_id
		);
		
		$this->db->insert('disc_cat_vote', $cat_vote_data); 
		
	}
	
	// Insert theme vote for user 
	private function vote_theme($username, $discussion_id, $theme_id)
	{
			
		$theme_vote_data = array (
			'vote' => '1',
			'theme_id' => $theme_id,
			'username' => $username,
			'disc_id' => $discussion_id
		);
		
		$this->db->insert('disc_theme_vote', $theme_vote_data);
	
	}
	
	// Returns a discussion record
	function get_discussion_details($discussion_id)
	{
	
		$this->db->select('*');
		$this->db->where('discussion_id', $discussion_id);
		
		$query = $this->db->get('discussion');
		
		if ($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return null;
		}
	
	}
	
	// Updates the last update field of a discussion
	function mark_as_updated($discussion_id)
	{
	
		$date = date("Y-m-d H:i:s");
		
		$discussion_data = array (
			'last_updated' => $date
		);
	
		$this->db->where('discussion_id', $discussion_id);
		$this->db->update('discussion', $discussion_data); 
	
	}
	
	// Finalizes a discussion
	function finalize($discussion_id)
	{
	
		$date = date("Y-m-d H:i:s");
		
		$discussion_data = array (
			'last_updated' => $date,
			'status' => 1
		);
	
		$this->db->where('discussion_id', $discussion_id);
		$this->db->update('discussion', $discussion_data); 
	
	}
	
}