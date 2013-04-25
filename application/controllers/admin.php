<?php 

class Admin extends MY_Controller 
{

	public function actions()
	{
		
		// Set menus
		$this->data['main_menu_id'] = 'admin';
		$this->data['sub_menu_id'] = 'actions';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('admin/sub_menu', $this->data);
		$this->load->view('admin/actions', $this->data);
		$this->load->view('footer', $this->data);
		
	}

	public function users()
	{
		
		// Set menus
		$this->data['main_menu_id'] = 'admin';
		$this->data['sub_menu_id'] = 'users';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('admin/sub_menu', $this->data);
		$this->load->view('admin/users', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	public function icons()
	{
		
		// Set menus
		$this->data['main_menu_id'] = 'admin';
		$this->data['sub_menu_id'] = 'icons';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('admin/sub_menu', $this->data);
		$this->load->view('admin/icons', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	public function misc()
	{
		
		// Set menus
		$this->data['main_menu_id'] = 'admin';
		$this->data['sub_menu_id'] = 'misc';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('admin/sub_menu', $this->data);
		$this->load->view('admin/misc', $this->data);
		$this->load->view('footer', $this->data);
		
	}
	
	public function settings()
	{
		
		// Set menus
		$this->data['main_menu_id'] = 'admin';
		$this->data['sub_menu_id'] = 'settings';

		// Load view content
		$this->load->view('header', $this->data);
		$this->load->view('admin/sub_menu', $this->data);
		$this->load->view('admin/settings', $this->data);
		$this->load->view('footer', $this->data);
		
	}

	public function email_part()
	{
		
		// Load view content
		$this->load->view('admin/parts/email', $this->data);
		
	}

	public function users_part($filter = null)
	{
		
		// Load models
		$this->load->model('users_model');
		
		// Pass data
		if (isset($filter))
		{
			if ($filter == 1)
			{
				$this->data['users'] = $this->users_model->find_users(Array('is_email_verified'=>FALSE));
			}
			else if ($filter == 2)
			{
				$this->data['users'] = $this->users_model->find_users(Array('warning_text !='=>''));
			}
			else if ($filter == 3)
			{
				$this->data['users'] = $this->users_model->find_users(Array('is_banned'=>TRUE));
			}
			else if ($filter == 4)
			{
				$this->data['users'] = $this->users_model->find_users(Array('is_mapmaker'=>TRUE));
			}
			else if ($filter == 5)
			{
				$this->data['users'] = $this->users_model->find_users(Array('is_admin'=>TRUE));
			}
		}
		else
		{
			$this->data['users'] = $this->users_model->get_users();
		}
		
		$this->data['filter'] = $filter;
		
		// Load view content
		$this->load->view('admin/parts/users', $this->data);
		
	}
	
	public function themes_part()
	{

		// Load models
		$this->load->model('themes_model');
		
		// Pass data
		$this->data['themes'] = $this->themes_model->get_themes();
	
		// Load view content
		$this->load->view('admin/parts/themes', $this->data);
		
	}
	
	public function genres_part()
	{
		
		// Load models
		$this->load->model('genres_model');
		
		// Pass data
		$this->data['genres'] = $this->genres_model->get_genres();
	
		// Load view content
		$this->load->view('admin/parts/genres', $this->data);
		
	}
	
	public function categories_part($genre_id = null)
	{
		
		// Load models
		$this->load->model('genres_model');
		$this->load->model('categories_model');

		if (isset($genre_id))
		{
			$genre = $this->genres_model->get_genre($genre_id);
		}
		else
		{
			$genre = $this->genres_model->get_genres()->row();
		}
		
		// Pass data
		$this->data['genre'] = $genre;
		$this->data['categories'] = $this->categories_model->get_categories_by_genre($genre->id);
	
		// Load view content
		$this->load->view('admin/parts/categories', $this->data);
		
	}
	
	public function countries_part()
	{
		
		// Load models
		$this->load->model('countries_model');
		
		// Pass data
		$this->data['countries'] = $this->countries_model->get_countries();
	
		// Load view content
		$this->load->view('admin/parts/countries', $this->data);
		
	}
	
	public function languages_part()
	{
		
		// Load models
		$this->load->model('languages_model');
		
		// Pass data
		$this->data['languages'] = $this->languages_model->get_languages();
	
		// Load view content
		$this->load->view('admin/parts/languages', $this->data);
		
	}
	
	public function image_settings_part()
	{

		// Pass data
		$this->data['max_image_width'] = $this->get('max_image_width');
		$this->data['max_image_height'] = $this->get('max_image_height');
		$this->data['max_image_size'] = $this->get('max_image_size');
		$this->data['image_types'] = $this->get('image_types');
	
		// Load view content
		$this->load->view('admin/parts/image_settings', $this->data);
		
	}
	
	public function email_settings_part()
	{

		// Pass data
		$this->data['email_host'] = $this->get('email_host');
		$this->data['email_port'] = $this->get('email_port');
		$this->data['email_username'] = $this->get('email_username');
		$this->data['email_password'] = $this->get('email_password');
		$this->data['email_from'] = $this->get('email_from');
		$this->data['email_from_name'] = $this->get('email_from_name');
	
		// Load view content
		$this->load->view('admin/parts/email_settings', $this->data);
		
	}
	
	public function notifications_part()
	{

		// Pass data
		$this->data['user_registration'] = $this->get('info_user_registration');
		$this->data['user_login'] = $this->get('info_user_login');
		$this->data['user_email_verification'] = $this->get('info_user_email_verification');
		$this->data['user_ban'] = $this->get('info_user_ban');
	
		// Load view content
		$this->load->view('admin/parts/notifications', $this->data);
		
	}
	
	public function email_notifications_part()
	{

		// Pass data
		$this->data['email_verification_subject'] = $this->get('email_verification_subject');
		$this->data['email_verification_body'] = $this->get('email_verification_body');
		$this->data['password_reset_subject'] = $this->get('password_reset_subject');
		$this->data['password_reset_body'] = $this->get('password_reset_body');
	
		// Load view content
		$this->load->view('admin/parts/email_notifications', $this->data);

		
	}
	
	public function email_announcement_part()
	{

		// Load view content
		$this->load->view('admin/parts/email_announcement', $this->data);
		
	}
	
}
