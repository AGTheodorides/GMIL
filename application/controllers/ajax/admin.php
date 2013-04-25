<?php

/**
 * This controller is responsible for administering the system. 
 */
class Admin extends MY_Controller 
{

	public function send_email()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}
			
			// Get post data
			$subject = $this->input->post('subject');
			$body = $this->input->post('body');
			
			// Load models
			$this->load->model('users_model');
			
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => $this->get('email_host'),
				'smtp_port' => $this->get('email_port'),
				'smtp_user' => $this->get('email_username'),
				'smtp_pass' => $this->get('email_password'),
			);
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			
			$this->email->from($this->get('email_from'), $this->get('email_from_name'));
			
			$bcc_list = array();
			
			//echo '{ "success": false, "message": "'.$this->users_model->get_allowed_emails()->num_rows().'" }';
			//return;
			
			foreach($this->users_model->get_allowed_emails()->result() as $record)
			{
				array_push($bcc_list, $record->email);
			}
			
			$this->email->bcc($bcc_list); 
		
			$this->email->subject($subject);
			$this->email->message($body);	
			
			if(!$this->email->send())
			{
				throw new Exception('<p> unable to send email. </p>');
			}

			echo '{ "success": true, "message": "<p> email announcement sent succesfully. </p>" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function send_test_email()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}
			
			$this->load->library('email_helper');
			
			$this->email_helper->send_email('agtheodorides@gmail.com', 'Email test', 'Testing the email library');

			echo '{ "success": true, "message": "<p> test email sent succesfully. </p>"}';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function add_theme()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$theme_text = $this->input->post('theme_text');
				
			// Load models
			$this->load->model('themes_model');
			
			// Add theme
			$theme_id = $this->themes_model->add_theme($theme_text);

			echo '{ "success": true, "theme_id": '.$theme_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function delete_theme()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$theme_id = $this->input->post('theme_id');
				
			// Load models
			$this->load->model('themes_model');

			// Delete theme
			$this->themes_model->delete_theme($theme_id);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function add_genre()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$genre_text = $this->input->post('genre_text');
				
			// Load models
			$this->load->model('genres_model');
			
			// Add genre
			$genre_id = $this->genres_model->add_genre($genre_text);

			echo '{ "success": true, "genre_id": '.$genre_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function delete_genre()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$genre_id = $this->input->post('genre_id');
				
			// Load models
			$this->load->model('genres_model');

			// Delete genre
			$this->genres_model->delete_genre($genre_id);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function add_category()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$genre_id = $this->input->post('genre_id');
			$category_text = $this->input->post('category_text');
				
			// Load models
			$this->load->model('categories_model');
			
			// Add genre
			$category_id = $this->categories_model->add_category($genre_id, $category_text);

			echo '{ "success": true, "category_id": '.$category_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function delete_category()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$category_id = $this->input->post('category_id');
				
			// Load models
			$this->load->model('categories_model');

			// Delete genre
			$this->categories_model->delete_category($category_id);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function add_language()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$language_text = $this->input->post('language_text');
				
			// Load models
			$this->load->model('languages_model');
			
			// Add language
			$language_id = $this->languages_model->add_language($language_text);

			echo '{ "success": true, "language_id": '.$language_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function delete_language()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$language_id = $this->input->post('language_id');
				
			// Load models
			$this->load->model('languages_model');

			// Delete language
			$this->languages_model->delete_language($language_id);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function add_country()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$country_text = $this->input->post('country_text');
				
			// Load models
			$this->load->model('countries_model');
			
			// Add country
			$country_id = $this->countries_model->add_country($country_text);

			echo '{ "success": true, "country_id": '.$country_id.', "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function delete_country()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$country_id = $this->input->post('country_id');
				
			// Load models
			$this->load->model('countries_model');

			// Delete country
			$this->countries_model->delete_country($country_id);
			
			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function update_custom_page()
	{
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Get post data
			$custom_page_id = $this->input->post('custom_page_id');
			$body = $this->input->post('body');
				
			// Load models
			$this->load->model('custom_pages_model');
			
			// Add country
			$country_id = $this->custom_pages_model->update_custom_page($custom_page_id, $body);

			echo '{ "success": true, "message": "success" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function save_image_settings()
	{		
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Save settings
			$this->set('max_image_width', $this->input->post('max_image_width'));
			$this->set('max_image_height', $this->input->post('max_image_height'));
			$this->set('max_image_size', $this->input->post('max_image_size'));
			$this->set('image_types', $this->input->post('image_types'));
			
			echo '{ "success": true, "message": "<p> image settings saved. </p>" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function save_email_settings()
	{		
		try
		{
		
			$me = $this->data['me'];

			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Save settings
			$this->set('email_host', $this->input->post('email_host'));
			$this->set('email_port', $this->input->post('email_port'));
			$this->set('email_username', $this->input->post('email_username'));
			$this->set('email_password', $this->input->post('email_password'));
			$this->set('email_from', $this->input->post('email_from'));
			$this->set('email_from_name', $this->input->post('email_from_name'));
			
			echo '{ "success": true, "message": "<p> email settings saved. </p>" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function save_notifications()
	{		
		try
		{
		
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Save settings
			$this->set('info_user_registration', $this->input->post('user_registration'));
			$this->set('info_user_login', $this->input->post('user_login'));
			$this->set('info_user_email_verification', $this->input->post('user_email_verification'));
			$this->set('info_user_ban', $this->input->post('user_ban'));
			
			echo '{ "success": true, "message": "<p> notifications saved. </p>" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
		
	public function save_email_notifications()
	{		
		try
		{
		
			if (!$this->me->is_admin)
			{
				throw new Exception('<p> action allowed to administrators only. </p>');
			}

			// Save settings
			$this->set('email_verification_subject', $this->input->post('email_verification_subject'));
			$this->set('email_verification_body', $this->input->post('email_verification_body'));
			$this->set('password_reset_subject', $this->input->post('password_reset_subject'));
			$this->set('password_reset_body', $this->input->post('password_reset_body'));
			
			echo '{ "success": true, "message": "<p> email notifications saved. </p>" }';
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
}