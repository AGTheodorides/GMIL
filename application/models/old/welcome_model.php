<?php

class Welcome_model extends CI_Model {
  
  // SIGN IN
	function sign_in($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		
		$query = $this->db->get('user');
		
	  return $query;
	}
	
	// carry the sign up in the database
	function sign_up() {
	  $sign_up_data = array(
			'username' => $this->input->post('su_username'),
			'password' => $this->input->post('su_password'),
			'language_id' => $this->input->post('su_language'),
			'country_id'  => $this->input->post('su_country')
		);
	  
		$insert = $this->db->insert('user', $sign_up_data);
		
		return $insert;
	}
	
	// get all countries from the database
	function get_countries() {
	  $query = $this->db->get('country');
	  
	  $countries = null;
	  foreach($query->result() as $r) {
	    $countries[] = $r;
	  }
	  
	  return $countries;
	}
	
	// get all the languages from the database
	function get_languages() {
	  $query = $this->db->get('language');
	  
	  $language = null;
	  foreach($query->result() as $r) {
	    $language[] = $r;
	  }
	  
	  return $language;
	}
}
