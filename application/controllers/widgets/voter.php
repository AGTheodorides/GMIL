<?php

class Voter extends MY_Controller 
{

	// Loads the page with default content
	public function index($icon_id, $field_type, $field_id)
	{

		// Load models
		$this->load->model('votes_model');
	
		$vote = $this->votes_model->get_vote($this->me->id, $icon_id, $field_type, $field_id);
	
		if (isset($vote))
		{
			$has_voted = 1;
		}
		else
		{
			$has_voted = 0;
		}	
	
		// Pass data
		$this->data['icon_id'] = $icon_id;
		$this->data['field_type'] = $field_type;
		$this->data['field_id'] = $field_id;
		$this->data['has_voted'] = $has_voted;
		$this->data['vote_count'] = $this->votes_model->get_vote_count($icon_id, $field_type, $field_id);
		
		// Load view content
		$this->load->view('/widgets/voter_widget_view', $this->data);
	
	}
	
}