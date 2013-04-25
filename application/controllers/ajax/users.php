<?php

/**
 * This controller is responsible for handling uploads. 
 */
class Users extends MY_Controller 
{
	
	public function send_verification_email()
	{
		try
		{
		
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action allowed to registered users only. </p>');
			}
		
			// Create verify id
			$verify_id = md5(date('Y-m-d H:i:s').$me->id);
			
			// Update user
			$this->load->model('users_model');
			$this->users_model->update_user_data($me->id, Array('verify_id'=>$verify_id, 'verify_expires'=>date("Y-m-d H:i:s",time()+60*60*5)));
			
			// Send email
			$this->load->library('email_helper');
			$this->email_helper->send_email($me->email, $this->get("email_verification_subject"), str_replace("#verify", site_url('profiles/verify/'.$verify_id), $this->get("email_verification_body")));
			
			echo '{ "success": true, "verify_id": "'.$verify_id.'", "message": "<p> email verification sent </p> <p> please check your email inbox </p>" }';
				
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function send_password_reset_email()
	{
		try
		{
		
			// Get post input
			$email = $this->input->post('email');

			// Create verify id
			$reset_id = md5(date('Y-m-d H:i:s').$email);
			
			// Update user
			$this->load->model('users_model');
			
			$user = $this->users_model->find_user(Array('email'=>$email));
			
			if (!$user)
			{
				throw new Exception('<p> unknown email address </p>');
			}
			
			// Check if user is banned
			if ($user->is_banned)
			{
				throw new Exception('<p> this account has been banned </p>');
			}
			
			$this->users_model->update_user_data($user->id, Array('reset_id'=>$reset_id, 'reset_expires'=>date("Y-m-d H:i:s",time()+60*60*5)));
			
			// Send email
			$this->load->library('email_helper');
			$this->email_helper->send_email($email, $this->get("password_reset_subject"), str_replace("#reset", site_url('profiles/password_reset/'.$reset_id), $this->get("password_reset_body")));

			echo '{ "success": true, "reset_id": "'.$reset_id.'", "message": "<p> password request sent </p> <p> please check your email inbox </p>" }';
				
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function reset_password()
	{
		try
		{
		
			// Get post input
			$reset_id = $this->input->post('reset_id');
			$password = $this->input->post('password');
			$password_verify = $this->input->post('password_verify');

			// Validate
			if ($password == '')
			{
				throw new Exception("<p> password cannot be empty. </p>"); 
			}
			if ($password != $password_verify)
			{
				throw new Exception("<p> passwords do not match. </p>"); 
			}
			
			// Update user
			$this->load->model('users_model');
			
			$user = $this->users_model->find_user(Array('reset_id'=>$reset_id));
			
			if (!$user)
			{
				throw new Exception('<p> invalid or expired password reset request. </p>');
			}
			
			$this->users_model->update_user_data($user->id, Array('password'=>md5($password),'reset_id'=>null,'reset_expires'=>null));
			
			echo '{ "success": true, "message": "<p> password reset successfully. </p>" }';
				
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function sign_in()
	{
		try
		{
		
			// Get post input
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$remember_me = $this->input->post('remember_me');
			
			// Load models
			$this->load->model('users_model');
			
			// Get user
			$user = $this->users_model->find_user(Array('username'=>$username, 'password'=>md5($password)));
			
			if ($user)
			{
				if (!$user->is_banned)
				{
					
					$this->session->set_userdata('current_user_id', $user->id);
					
					if($remember_me)
					{
					
						// Create auth cookie id
						$auth_cookie_id = md5(date('Y-m-d H:i:s').$user->id);
					
						// Update user
						$this->users_model->update_user_data($user->id, Array('auth_cookie_id'=>$auth_cookie_id, 'auth_cookie_expires'=>null));
					
						// Create cookie
						$this->load->helper('cookie');
						$this->input->set_cookie(Array(
							'name'=>'gmit_auth_cookie',
							'value'=>$auth_cookie_id,
							'expire'=> 86500
						));
						
					}
					
					$this->session->set_userdata('info', $this->get("info_user_login"));
				
					echo '{ "success": true, "user_id": '.$user->id.', "message": "success" }';
				
				}
				else
				{
					echo '{ "success": false, "message": "<p> this account has been banned </p>" }';
				}
			}
			else
			{
				echo '{ "success": false, "message": "<p> invalid username or password </p>" }';
			}
		
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function sign_off()
	{
		try
		{
			
			$me = $this->data['me'];

			if ($me->is_guest)
			{
				throw new Exception('<p> not signed in </p>');
			}
		
			// Disable auth cookie
			$this->users_model->update_user_data($me->id, Array('auth_cookie_id'=>null, 'auth_cookie_expires'=>null));
			
			// Set to guest
			$this->session->set_userdata('current_user_id', 1); 
				
			echo '{ "success": true, "message": "success" }';
			
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function add()
	{
		try
		{
		
			require_once(BASEPATH.'recaptchalib.php');
			
			$private_key = "6Le1KtsSAAAAAMXYGpQIOO8j6eWcOtzm_ESHPzRk";
			
			$resp = recaptcha_check_answer($private_key,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

			// Get post input
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password_verify = $this->input->post('password_verify');
			$email = $this->input->post('email');
			$allow_email = $this->input->post('allow_email') != '' ? 1 : 0;
			$image_url = $this->input->post('image_url');
			$country_id = $this->input->post('country_id');
			$language_id = $this->input->post('language_id');
			$post = $this->input->post();
		
			// Load models
			$this->load->model('users_model');
			
			// Validate
			if ($username == '')
			{
				throw new Exception("<p> username cannot be empty. </p>"); 
			}
			if ($password == '')
			{
				throw new Exception("<p> password cannot be empty. </p>"); 
			}
			if ($password != $password_verify)
			{
				throw new Exception("<p> passwords do not match. </p>"); 
			}
			if ($email == '')
			{
				throw new Exception("<p> email cannot be empty. </p>"); 
			}
			if (!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email))
			{
				throw new Exception("<p> invalid email address. </p>"); 
			}
			if (!$resp->is_valid) 
			{
				throw new Exception('<p> invalid captcha. </p>');
			}
			if ($this->users_model->get_user_by_username($username))
			{
				throw new Exception("<p> username '".$username."' is in use. </p>");
			}
			if ($this->users_model->get_user_by_email($email))
			{
				throw new Exception("<p> email '".$email."' is in use. </p>");
			}
			
			// Add user
			$user_id = $this->users_model->add_user($username, md5($password), $email, $allow_email, $country_id, $language_id);
		
			if ($post['is_mapmaker'])
			{
				
				$this->users_model->update_user_data($user_id, Array('is_mapmaker'=>TRUE,'project_name'=>@$post['project_name'],'project_url'=>@$post['project_url']));
			}

			// Auto-sign in new user
			$this->session->set_userdata('current_user_id', $user_id);

			// Show friendly infoline
			$this->session->set_userdata('info', $this->get("info_user_registration"));
			
			echo '{ "success": true, "user_id": '.$user_id.', "message": "<p> profile created succesfully. </p>" }';
			
		}
		catch (Exception $e)
		{
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		} 
	}
	
	public function update()
	{
		try
		{
		
			// Get post input
			$user_id = $this->input->post('user_id');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$password_verify = $this->input->post('password_verify');
			$email = $this->input->post('email');
			$allow_email = $this->input->post('allow_email') != '' ? 1 : 0;
			$image_url = $this->input->post('image_url');
			$level = $this->input->post('level');
			$country_id = $this->input->post('country_id');
			$language_id = $this->input->post('language_id');
			$post = $this->input->post();

			// Security check
			if ($this->me->is_guest)
			{
				throw new Exception('<p> action allowed to registered users only. </p>');
			}
			if ($this->me->id != $user_id && !$this->me->is_admin)
			{
				throw new Exception("<p> not allowed to update this account </p>"); 
			}
			
			// Load models
			$this->load->model('users_model');
			
			// Validate
			$user = $this->users_model->find_user(Array('id'=>$user_id));
			if ($user)
			{
				if ($username == '')
				{
					throw new Exception("<p> username cannot be empty. </p>"); 
				}
				if ($password != "no_change")
				{
					if ($password == '')
					{
						throw new Exception("<p> password cannot be empty. </p>"); 
					}
					if ($password != $password_verify)
					{
						throw new Exception("<p> passwords do not match. </p>"); 
					}
				}
				if ($email == '')
				{
					throw new Exception("<p> email cannot be empty. </p>"); 
				}
				if (!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email))
				{
					throw new Exception("<p> invalid email address. </p>"); 
				}
				if($user->username != $username && $this->users_model->get_user_by_username($username))
				{
					throw new Exception("<p> username '".$username."' is in use. </p>");
				}
				if($user->email != $email && $this->users_model->get_user_by_email($email))
				{
					throw new Exception("<p> email '".$email."' is in use. </p>");
				}
			}
			else
			{
				throw new Exception("<p> invalid user id. </p>");
			}
			
			// Update user basic info
			$this->users_model->update_user($user_id, $username, $email, $allow_email, $country_id, $language_id);
			
			// Update user password if requested
			if ($password != "no_change")
			{
				$this->users_model->update_user_password($user_id, md5($password));
			}
			
			if (array_key_exists('is_mapmaker', $post))
			{
				$this->users_model->update_user_data($user_id, Array('is_mapmaker'=>TRUE,'project_name'=>$post['project_name'],'project_url'=>$post['project_url']));
			}
			else
			{
				$this->users_model->update_user_data($user_id, Array('is_mapmaker'=>FALSE,'project_name'=>NULL,'project_url'=>NULL));
			}

			if ($this->me->is_admin)
			{
				if (array_key_exists('is_admin', $post))
				{
					$this->users_model->update_user_data($user_id, Array('is_admin'=>TRUE));
				}
				else
				{
					$this->users_model->update_user_data($user_id, Array('is_admin'=>FALSE));
				}
			}
			
			echo '{ "success": true, "message": "<p> profile saved. </p>" }';
			
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function delete()
	{
		try
		{
		
			// Get post input
			$user_id = $this->input->post('user_id');
			
			// Security check
			if (!$this->me->is_admin && $this->me->id != $user_id)
			{
				throw new Exception("<p> not allowed to delete this account </p>"); 
			}
				
			// Load models
			$this->load->model('users_model');
			
			// Delete records
			$this->users_model->delete_user($user_id);
				
			echo '{ "success": true, "message": "success" }';
			
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}

	public function ban()
	{
		try
		{
		
			// Get post input
			$user_id = $this->input->post('user_id');
			
			// Security check
			if (!$this->me->is_admin)
			{
				throw new Exception("<p> not allowed to ban this account </p>"); 
			}
				
			// Load models
			$this->load->model('users_model');
			
			// Update record
			$this->users_model->update_user_data($user_id, Array('is_banned'=>TRUE));
				
			echo '{ "success": true, "message": "success" }';
			
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}
	
	public function unban()
	{
		try
		{
		
			// Get post input
			$user_id = $this->input->post('user_id');
			
			// Security check
			if (!$this->me->is_admin)
			{
				throw new Exception("<p> not allowed to unban this account </p>"); 
			}
				
			// Load models
			$this->load->model('users_model');
			
			// Update record
			$this->users_model->update_user_data($user_id, Array('is_banned'=>FALSE));
				
			echo '{ "success": true, "message": "success" }';
			
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}	

	public function warn()
	{
		try
		{
		
			// Get post input
			$user_id = $this->input->post('user_id');
			
			// Security check
			if (!$this->me->is_admin)
			{
				throw new Exception("<p> not allowed to warn this account </p>"); 
			}
				
			// Load models
			$this->load->model('users_model');
			
			// Update record
			$this->users_model->update_user_data($user_id, Array('warning_text'=>$this->input->post('warning_text')));
				
			echo '{ "success": true, "message": "success" }';
			
		}
		catch (Exception $e)
		{
		
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		} 
	}	
	
}