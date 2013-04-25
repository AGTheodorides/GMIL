<?php

/**
 * This controller is responsible for managing icons. 
 */
class Icons extends MY_Controller 
{

	public function add()
	{
		try
		{
			
			// Registered users only
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action not allowed to guests. </p>');
			}
				
			// Get post data
			$title_text = $this->input->post('title_text');
			$definition_text = $this->input->post('definition_text');
			$temp_image_url = $this->input->post('temp_image_url');
			$category_id = $this->input->post('category_id');
			$theme_id = $this->input->post('theme_id');

			// Validate
			if ($title_text == '')
			{
				throw new Exception('<p> title cannot be empty. </p>');
			}
			if ($temp_image_url == '')
			{
				throw new Exception('<p> you must choose an image. </p>');
			}
			if ($definition_text == '')
			{
				throw new Exception('<p> definition cannot be empty. </p>');
			}
		
			// Load models
			$this->load->model('icons_model');
			$this->load->model('titles_model');
			$this->load->model('definitions_model');
			$this->load->model('images_model');
			$this->load->model('categories_model');
			$this->load->model('themes_model');
			$this->load->model('votes_model');
			
			// Begin transaction
			$this->db->trans_begin();
			
			// Create icon record
			$icon_id = $this->icons_model->add_icon($this->me->id);
			
			// Move temp image
			$image_url = $this->p_move_temp_image($temp_image_url);

			// Add fields
			$title_id = $this->titles_model->add_title($icon_id, $title_text);
			$definition_id = $this->definitions_model->add_definition($icon_id, $definition_text);
			$image_id = $this->images_model->add_image($icon_id, $image_url);
			$category_entry_id =  $this->categories_model->add_category_entry($icon_id, $category_id);
			$theme_entry_id = $this->themes_model->add_theme_entry($icon_id, $theme_id);
			
			// Add votes
			$this->votes_model->add_vote($this->me->id, $icon_id, 1, $title_id, 1);
			$this->votes_model->add_vote($this->me->id, $icon_id, 2, $definition_id, 1);
			$this->votes_model->add_vote($this->me->id, $icon_id, 3, $image_id, 1);
			$this->votes_model->add_vote($this->me->id, $icon_id, 4, $category_entry_id, 1);
			$this->votes_model->add_vote($this->me->id, $icon_id, 5, $theme_entry_id, 1);
			
			// Add original fields
			$this->icons_model->add_icon_original_fields($icon_id, $title_text, $definition_text, $image_url, $category_id, $theme_id);
			
			if ($this->db->trans_status() === FALSE) 
			{
				throw new Exception('an unknown database error occured.');
			} 
			else 
			{
				// Commit transaction if there are no errors
				$this->db->trans_commit();
			}
		
			echo '{ "success": true, "icon_id": '.$icon_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			// Rollback transaction
			$this->db->trans_rollback();
	
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function delete()
	{
		try
		{
		
			// Administrators only
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post input
			$icon_id = $this->input->post('icon_id');
			
			// Load models
			$this->load->model('icons_model');
			
			// Add records
			$this->icons_model->delete_icon($icon_id);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function flag()
	{
		try
		{
		
			// Get post input
			$icon_id = $this->input->post('icon_id');

			// Security check
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action not allowed. </p>');
			}
		
			// Load models
			$this->load->model('flags_model');
			
			// Add flag
			$flag_id = $this->flags_model->add_flag(Array('icon_id'=>$icon_id,'user_id'=>$this->me->id));

			echo '{ "success": true, "flag_id": '.$flag_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function unflag()
	{
		try
		{
		
			// Get post input
			$flag_id = $this->input->post('flag_id');

			// Load models
			$this->load->model('flags_model');
			
			// Get flag record
			$flag = $this->flags_model->get_flag($flag_id);
			
			// Security check
			if (!$this->me->is_admin && $flag->user_id != $this->me->id)
			{
				throw new Exception('<p> action not allowed. </p>');
			}
		
			// Update icon
			$this->flags_model->delete_flag($flag_id);

			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function set_flag_reason()
	{
		try
		{
		
			// Get post input
			$flag_id = $this->input->post('flag_id');
			$reason = $this->input->post('reason');

			// Load models
			$this->load->model('flags_model');
			
			// Get flag record
			$flag = $this->flags_model->get_flag($flag_id);
			
			// Security check
			if (!$this->me->is_admin && $flag->user_id != $this->me->id)
			{
				throw new Exception('<p> action not allowed. </p>');
			}
		
			// Update icon
			$this->flags_model->update_flag($flag_id, Array('reason'=>$reason));

			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function follow()
	{
		try
		{
		
			// Registered users only
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action not allowed to guests. </p>');
			}
		
			// Get post input
			$icon_id = $this->input->post('icon_id');

			// Load models
			$this->load->model('icons_model');
			
			// Add records
			$this->icons_model->follow_icon($icon_id, $this->me->id);

			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function unfollow()
	{
		try
		{
		
			// Registered users only
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action not allowed to guests. </p>');
			}
		
			// Get post input
			$icon_id = $this->input->post('icon_id');
			
			// Load models
			$this->load->model('icons_model');
			
			// Add records
			$this->icons_model->unfollow_icon($icon_id, $this->me->id);

			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}

	public function feature()
	{
		try
		{
		
			// Administrators only
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post input
			$icon_id = $this->input->post('icon_id');
			
			// Load models
			$this->load->model('icons_model');
			
			// Add records
			$this->icons_model->update_icon($icon_id, array( 'featured' => 1 ));

			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function unfeature()
	{
		try
		{
		
			// Administrators only
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post input
			$icon_id = $this->input->post('icon_id');
			
			// Load models
			$this->load->model('icons_model');
			
			// Add records
			$this->icons_model->update_icon($icon_id, array( 'featured' => 0 ));
			
			// Update icon
			$this->icons_model->update_icon($icon_id, null);

			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}

	public function finalize()
	{
		try
		{
		
			// Administrators only
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post input
			$icon_id = $this->input->post('icon_id');
			
			// Load models
			$this->load->model('icons_model');
			
			// Get icon record with details
			$icon = $this->icons_model->get_icon($icon_id);
			
			// Add final fields
			$this->icons_model->add_icon_final_fields($icon_id, $icon->title_text, $icon->definition_text, $icon->image_url, $icon->category_id, $icon->theme_id);

			// Update icon
			$this->icons_model->update_icon($icon_id, array( 'status' => 1 ));

			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function unfinalize()
	{
		try
		{
		
			// Administrators only
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post input
			$icon_id = $this->input->post('icon_id');
			
			// Load models
			$this->load->model('icons_model');
			
			// Delete final fields
			$this->icons_model->delete_icon_final_fields($icon_id);

			// Update icon
			$this->icons_model->update_icon($icon_id, array( 'status' => 0 ));
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function update_original_field()
	{
		try
		{
	
			// Get post data
			$icon_id = $this->input->post('icon_id');
			$field_id = $this->input->post('field_id');
			$field_type = $this->input->post('field_type');
			$field_data = $this->input->post('field_data');

			// Validate
			if ($field_data == '')
			{
				throw new Exception('<p> text cannot be empty. </p>');
			}
			
			// Load models
			$this->load->model('icons_model');
			$this->load->model('votes_model');
			
			// Load icon record
			$icon = $this->icons_model->get_icon($icon_id);
			
			// Administrators or icon owners
			if ((!$this->me->is_admin) && ($this->me->id != $icon->creator_id))
			{
				throw new Exception('<p> action not allowed. </p>');
			}

			// Load models
			$this->load->model('icons_model');
			
			if ($field_type == 1)
			{
				$this->icons_model->update_icon_original_fields($icon_id, array('title_text'=>$field_data));
			}
			elseif ($field_type == 2)
			{
				$this->icons_model->update_icon_original_fields($icon_id, array('definition_text'=>$field_data));
			}
			elseif ($field_type == 3)
			{
				if (pathinfo($field_data,  PATHINFO_DIRNAME) == 'temp')
				{
				
					// Copy temp image
					$image_url = $this->p_move_temp_image($field_data);
					
					// Update original record
					$this->icons_model->update_icon_original_fields($icon_id, array('url'=>$image_url));
				
				}
			}
			elseif ($field_type == 4)
			{
				$this->icons_model->update_icon_original_fields($icon_id, array('category_id'=>$field_data));
			}
			elseif ($field_type == 5)
			{
				$this->icons_model->update_icon_original_fields($icon_id, array('theme_id'=>$field_data));
			}
			else
			{
				throw new Exception('Invalid field type');
			}

			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function update_final_field()
	{
		try
		{
	
			// Get post data
			$icon_id = $this->input->post('icon_id');
			$field_id = $this->input->post('field_id');
			$field_type = $this->input->post('field_type');
			$field_data = $this->input->post('field_data');

			// Validate
			if ($field_data == '')
			{
				throw new Exception('<p> text cannot be empty. </p>');
			}
			
			// Load models
			$this->load->model('icons_model');
			$this->load->model('votes_model');
			
			// Load icon record
			$icon = $this->icons_model->get_icon($icon_id);
			
			// Administrators or icon owners
			if ((!$this->me->is_admin) && ($this->me->id != $icon->creator_id))
			{
				throw new Exception('<p> action not allowed. </p>');
			}

			// Load models
			$this->load->model('icons_model');
			
			if ($field_type == 1)
			{
				$this->icons_model->update_icon_final_fields($icon_id, array('title_text'=>$field_data));
			}
			elseif ($field_type == 2)
			{
				$this->icons_model->update_icon_final_fields($icon_id, array('definition_text'=>$field_data));
			}
			elseif ($field_type == 3)
			{
				if (pathinfo($field_data,  PATHINFO_DIRNAME) == 'temp')
				{
				
					// Copy temp image
					$image_url = $this->p_move_temp_image($field_data);
					
					// Update original record
					$this->icons_model->update_icon_final_fields($icon_id, array('url'=>$image_url));
				
				}
			}
			elseif ($field_type == 4)
			{
				$this->icons_model->update_icon_final_fields($icon_id, array('category_id'=>$field_data));
			}
			elseif ($field_type == 5)
			{
				$this->icons_model->update_icon_final_fields($icon_id, array('theme_id'=>$field_data));
			}
			else
			{
				throw new Exception('Invalid field type');
			}

			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function add_field()
	{
		try
		{
	
			// Registered users only
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action not allowed to guests. </p>');
			}
				
			// Get post data
			$icon_id = $this->input->post('icon_id');
			$field_type = $this->input->post('field_type');
			$field_data = $this->input->post('field_data');

			// Validate
			if ($field_data == '' && $temp_image_id == '')
			{
				throw new Exception('<p> text cannot be empty. </p>');
			}
			
			// Load models
			$this->load->model('icons_model');
			$this->load->model('votes_model');
			
			if ($field_type == 1)
			{
				$this->load->model('titles_model');
				$field_id = $this->titles_model->add_title($icon_id, $field_data);
			}
			elseif ($field_type == 2)
			{
				$this->load->model('definitions_model');
				$field_id = $this->definitions_model->add_definition($icon_id, $field_data);
			}
			elseif ($field_type == 3)
			{
				$this->load->model('images_model');
				$image_url = $this->p_move_temp_image($field_data);
				$field_id = $this->images_model->add_image($icon_id, $image_url);
			}
			elseif ($field_type == 4)
			{
				$this->load->model('categories_model');
				$field_id =  $this->categories_model->add_category_entry($icon_id, $field_data);
			}
			elseif ($field_type == 5)
			{
				$this->load->model('themes_model');
				$field_id = $this->themes_model->add_theme_entry($icon_id, $field_data);
			}
			else
			{
				throw new Exception('Invalid field type');
			}

			// Create vote
			$this->votes_model->add_vote($this->me->id, $icon_id, $field_type, $field_id, 1);			
			
			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "field_id": '.$field_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}

	public function update_field()
	{
		try
		{
	
			// Get post data
			$icon_id = $this->input->post('icon_id');
			$field_id = $this->input->post('field_id');
			$field_type = $this->input->post('field_type');
			$field_data = $this->input->post('field_data');

			// Validate
			if ($field_data == '')
			{
				throw new Exception('<p> text cannot be empty. </p>');
			}
			
			// Load models
			$this->load->model('icons_model');
			$this->load->model('votes_model');
			
			// Load icon record
			$icon = $this->icons_model->get_icon($icon_id);
			
			// Administrators or icon owners
			if ((!$this->me->is_admin) && ($this->me->id != $icon->creator_id))
			{
				throw new Exception('<p> action not allowed. </p>');
			}

			if ($field_type == 1)
			{
				$this->load->model('titles_model');
				$this->titles_model->update_title($field_id, $field_data);
			}
			elseif ($field_type == 2)
			{
				$this->load->model('definitions_model');
				$this->definitions_model->update_definition($field_id, $field_data);
			}
			elseif ($field_type == 3)
			{
				$this->load->model('images_model');
				$image_url = $this->p_move_temp_image($field_data);
				$this->images_model->update_image($field_id, $image_url);
			}
			elseif ($field_type == 4)
			{
				$this->load->model('categories_model');
				$this->categories_model->update_category_entry($field_id, $field_data);
			}
			elseif ($field_type == 5)
			{
				$this->load->model('themes_model');
				$this->themes_model->update_theme_entry($field_id, $field_data);
			}
			else
			{
				throw new Exception('Invalid field type');
			}
			
			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function delete_field()
	{
		try
		{
	
			// Administrators only
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$icon_id = $this->input->post('icon_id');
			$field_id = $this->input->post('field_id');
			$field_type = $this->input->post('field_type');
		
			// Load models
			$this->load->model('icons_model');

			if ($field_type == 1)
			{
				$this->load->model('titles_model');
				$this->titles_model->delete_title($field_id);
			}
			elseif ($field_type == 2)
			{
				$this->load->model('definitions_model');
				$this->definitions_model->delete_definition($field_id);
			}
			elseif ($field_type == 3)
			{
				$this->load->model('images_model');
				$this->images_model->delete_image($field_id);
			}
			elseif ($field_type == 4)
			{
				$this->load->model('categories_model');
				$this->categories_model->delete_category_entry($field_id);
			}
			elseif ($field_type == 5)
			{
				$this->load->model('themes_model');
				$this->themes_model->delete_theme_entry($field_id);
			}
			else
			{
				throw new Exception('Invalid field type');
			}

			// Update icon
			$this->icons_model->update_icon($icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function add_comment()
	{
		try
		{

			// Registered users only
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action not allowed to guests. </p>');
			}
		
			// Get post input
			$icon_id = $this->input->post('icon_id');
			$field_type = $this->input->post('field_type');
			$comment_text = $this->input->post('comment_text');

			// Validate
			if ($comment_text == '')
			{
				throw new Exception('<p> text cannot be empty. </p>');
			}
			
			// Load models
			$this->load->model('icons_model');
			$this->load->model('comments_model');
			
			// Add record
			$comment_id = $this->comments_model->add_comment($icon_id, $field_type, $this->me->id, $comment_text);
			
			// Update icon
			$this->icons_model->update_icon($icon_id, null);

			echo '{ "success": true, "comment_id": '.$comment_id.', "message": "success" }';
	
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function update_comment()
	{
		try
		{
		
			// Get post input
			$comment_id = $this->input->post('comment_id');
			$comment_text = $this->input->post('comment_text');
			
			// Validate
			if ($comment_text == '')
			{
				throw new Exception('<p> text cannot be empty. </p>');
			}
		
			// Load models
			$this->load->model('icons_model');
			$this->load->model('comments_model');
			
			// Get comment record
			$comment = $this->comments_model->get_comment($comment_id);
			
			// Administrators or comment owners only
			if ((!$this->me->is_admin) && ($this->me->id != $comment->creator_id))
			{
				throw new Exception('<p> action not allowed. </p>');
			}
		
			// Delete record
			$this->comments_model->update_comment($comment_id, $comment_text);

			// Update icon
			$this->icons_model->update_icon($comment->icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function delete_comment()
	{
		try
		{
		
			// Get post input
			$comment_id = $this->input->post('comment_id');
			
			// Load models
			$this->load->model('icons_model');
			$this->load->model('comments_model');
			
			// Get comment record
			$comment = $this->comments_model->get_comment($comment_id);
			
			// Administrators or comment owners only
			if ((!$this->me->is_admin) && ($this->me->id != $comment->creator_id))
			{
				throw new Exception('<p> action not allowed. </p>');
			}
		
			// Delete records
			$this->comments_model->delete_comment($comment_id);

			// Update icon
			$this->icons_model->update_icon($comment->icon_id, null);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function vote_up()
	{	
		try
		{
		
			// Get post data
			$icon_id = $this->input->post('icon_id');
			$field_type = $this->input->post('field_type');
			$field_id = $this->input->post('field_id');
		
			// Load models
			$this->load->model('icons_model');
			$this->load->model('votes_model');
			
			$vote = $this->votes_model->get_vote($this->me->id, $icon_id, $field_type, $field_id);
			
			if (!isset($vote))
			{
			
				// Add record
				$vote_id = $this->votes_model->add_vote($this->me->id, $icon_id, $field_type, $field_id, 1);
				
				// Update icon
				$this->icons_model->update_icon($icon_id, null);
				
				echo '{ "success": true, "vote_id": '.$vote_id.', "message": "success" }';
			
			}
			else
			{
			
				echo '{ "success": false, "message": "you cannot vote twice" }';
			
			}
			
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
			
		}
	} 

	public function vote_down()
	{
		try
		{
		
			// Registered users only
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action not allowed to guests. </p>');
			}
		
			// Get post data
			$icon_id = $this->input->post('icon_id');
			$field_type = $this->input->post('field_type');
			$field_id = $this->input->post('field_id');
		
			// Load models
			$this->load->model('icons_model');
			$this->load->model('votes_model');
			
			if (!isset($vote))
			{
			
				// Add record
				$vote_id = $this->votes_model->add_vote($this->me->id, $icon_id, $field_type, $field_id, -1);
				
				// Update icon
				$this->icons_model->update_icon($icon_id, null);
				
				echo '{ "success": true, "vote_id": '.$vote_id.', "message": "success" }';
			
			}
			else
			{
			
				echo '{ "success": false, "message": "you cannot vote twice" }';
			
			}

		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
			
		}
	} 
	
	public function remove_vote()
	{
		try
		{
		
			// Get post data
			$vote_id = $this->input->post('vote_id');
		
			// Load models
			$this->load->model('votes_model');

			// Get vote record
			$vote = $this->votes_model->get_vote($vote_id);
		
			// Administrators or vote owners only
			if ((!$this->me->is_admin) && ($vote['user_id'] != $this->me->id))
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}
			
			// Remove vote
			$this->votes_model->delete_vote($vote_id);
		
			echo '{ "success": true, "message": "success" }';

		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
			
		}
	}

	private function p_move_temp_image($temp_image_url)
	{

		// Calculate url
		$icon_image_url = 'icons/'.date("Y_m_d_H_i_s").'.'.pathinfo($temp_image_url, PATHINFO_EXTENSION);
		
		// Calculate real paths
		$real_temp_image_url = realpath(APPPATH . '../images/'.$temp_image_url);
		$real_icon_image_url = realpath(APPPATH . '../images').'/'.$icon_image_url;
		
		if(file_exists($real_temp_image_url) && isset($real_icon_image_url))
		{
			
			// Move image
			rename($real_temp_image_url, $real_icon_image_url);
			
		}
		else
		{
			throw new Exception('image file not found');
		}
		
		return $icon_image_url;
	
	}

}