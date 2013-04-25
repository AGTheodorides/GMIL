<?php

class Home_model extends CI_Model {
  
  // get all the user information from the database
  public function get_user_information($user_id) {
    $user = null;
    $this->db->where('username', $user_id);
    $user = $this->db->get('user')->row();

    return $user;
  } // get_user_information
  
  // get all the genres from the database
  public function get_genre() {
    $this->db->select('genre_id, genre');
    $q = $this->db->get('genre');
    
    $genre = null;
    foreach($q->result() as $r) {
      
      $this->db->where('genre', $r->genre_id);
      $query = $this->db->get('category');
      
      $category = null;
      foreach($query->result() as $c) {
        
        $this->db->select('disc_id');
		    $this->db->where('cat_id', $c->category_id);
		    $query2 = $this->db->get('disc_cat_vote'); 
        
        $discussions = null;
        foreach($query2->result() as $d) {
          $this->db->select('title');
		      $this->db->where('discussion_id', $d->disc_id);
		      $query3 = $this->db->get('title', 1);
		      if ($query3->num_rows() > 0) {
		        $d->title = $query3->row()->title;
		        $discussions[] = $d;
		      }
        }
        
        $c->discussions = $discussions;
        $category[] = $c;
      }
      
      $r->categories = $category;
      $genre[] = $r;
    }
    return $genre;
  } // get_genre
  
  
  // get all discussions ordered by most recently created
  public function get_recently_created() {
    $this->db->select('discussion_id, created');
    $this->db->order_by('created', "DESC");
    $q = $this->db->get('discussion');
    
    $discussions = null;
    foreach($q->result() as $d) {
      $this->db->select('title, creation_time');
      $this->db->where('discussion_id', $d->discussion_id);
      $this->db->order_by('creation_time', "ASC");
      $row = $this->db->get('title', 1)->row();
      
      $d->title = $row->title;
      
      $discussions[] = $d;
    }
    
    return $discussions;
  } // get_recently_created
  
  // get all discussions with the number of votes on them
  // sort by most votede discussion
  public function get_discussion_votes() {
    $this->db->select('discussion_id');
    $discussion_query = $this->db->get('discussion');
    
    $discussions = null;
    foreach($discussion_query->result() as $d) {
      $this->db->select('title, creation_time');
      $this->db->where('discussion_id', $d->discussion_id);
      $this->db->order_by('creation_time', "ASC");
      $d->title = $this->db->get('title', 1)->row()->title;
      
      
      $this->db->where('disc_id', $d->discussion_id);
      $query = $this->db->get('disc_cat_vote');
      $d->votes = $query->num_rows();
      
      $this->db->where('disc_id', $d->discussion_id);
      $query = $this->db->get('disc_theme_vote');
      $d->votes = $d->votes + $query->num_rows();
      
      $this->db->where('discussion_id', $d->discussion_id);
      $query = $this->db->get('title_by_disc', 1);
      $d->votes = $d->votes + $query->row()->vote_count;
      
      $this->db->where('discussion_id', $d->discussion_id);
      $query = $this->db->get('theme_by_disc', 1);
      $d->votes = $d->votes + $query->row()->vote_count;
      
      $this->db->where('discussion_id', $d->discussion_id);
      $query = $this->db->get('definition_by_disc', 1);
      $d->votes = $d->votes + $query->row()->vote_count;
      
      
      $discussions[] = $d;
    }
    
    usort($discussions, function($a, $b) {
        return $a->votes < $b->votes;
    });
    
    
    return $discussions;
  } // get_discussion_votes
  
}
