<?php

class Create_model extends CI_Model {
	
	// get all the themes from the database
	function get_themes()
	{
	
		$this->db->select('*');
		$this->db->order_by('theme', 'ASC');
		
		return $this->db->get('theme'); 
		
	}
	
	// get all the genres from the database
	function get_genres()
	{
	
		$this->db->select('*');
		$this->db->order_by('genre', 'ASC');
		
		return $this->db->get('genre'); 
		
	}
	// get all the categories from the database
	function get_categories()
	{
	
		$this->db->select('*');
		$this->db->order_by('category', 'ASC');
		
		return $this->db->get('category');
		
	}
	
	
	// get all the categories by genre from the database
	function get_categories_by_genre($genre_id)
	{
	
		$this->db->select('*');
		$this->db->where('genre_id', $genre_id);
		$this->db->order_by('category', 'ASC');
		
		return $this->db->get('category'); 
		
	}
	
	// create a new discussion in the database
	function create_discussion($username, $url) {
		$date = date("Y-m-d H:i:s");
		
		// Read data from form
		$title = $this->input->post('su_title');
		$definition = $this->input->post('su_definition');
		$theme_id = $this->input->post('su_theme_id');
		$category_id = $this->input->post('su_category_id');
		
		//create entry for new discussion and insert in discussion table
		$disc_data = array(
			'created' => $date,
			'status' => '0' ,
			'last_updated' => $date,
			'discussion_creator' => $username
		);

		$this->db->insert('discussion', $disc_data); 
		
		//get newly assigned discussion id
		
		$disc_id = $this->db->insert_id();
		
		//insert in title table
		$title_data = array(  
			'title' => $title,
			'title_creator' => $username,
			'creation_time' => $date,
			'discussion_id' => $disc_id
		);
		
		$this->db->insert('title', $title_data); 
		 
		//get newly assigned title id
		$title_id = $this->db->insert_id();
		
		//insert title vote
		$title_vote_data = array(  
			'title_id' => $title_id,
			'username' => $username,
			'vote' => '1'
		);
		$this->db->insert('title_vote', $title_vote_data); 
		
		//insert icon
		$icon_data = array(  
			'url' => $url,
			'icon_creator' => $username,
			'creation_time' => $date,
			'discussion_id' => $disc_id
		);
		$this->db->insert('icon', $icon_data); 
				
		//get newly assigned icon id
		$icon_id = $this->db->insert_id();
		
		//insert icon vote
		$icon_vote_data = array(  
			'icon_id' => $icon_id,
			'username' => $username,
			'vote' => '1'
		);
		$this->db->insert('icon_vote', $icon_vote_data); 
		
		
		//insert definition
		$def_data = array(
			'definition' => $definition,
			'def_creator' => $username,
			'creation_time' => $date,
			'discussion_id' => $disc_id
		);
		
		$this->db->insert('definition', $def_data); 
	
		//get newly assigned definition id
		$def_id = $this->db->insert_id();
		
		//insert title vote
		$def_vote_data = array(  
			'def_id' => $def_id,
			'username' => $username,
			'vote' => '1'
		);
		$this->db->insert('def_vote', $def_vote_data); 
		
		//insert category vote for user 
		$cat_vote_data = array (
			'vote' => '1',
			'cat_id' => $category_id,
			'username' => $username,
			'disc_id' => $disc_id
		);
		$this->db->insert('disc_cat_vote', $cat_vote_data); 
		
		//insert theme vote for user 
		$theme_vote_data = array (
			'vote' => '1',
			'theme_id' => $theme_id,
			'username' => $username,
			'disc_id' => $disc_id
		);
		$this->db->insert('disc_theme_vote', $theme_vote_data); 
		
		return $disc_id;
		
	}
}
