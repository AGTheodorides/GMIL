<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_helper
{

	/* CONSTANTS */
	
	private $user_var = 'CURRENT_USER_RECORD';

	// Constructor
  function __construct()
  {
	
		$CI =& get_instance();
		$CI->load->model('settings_model');
		
  }	
	
	/* EMAIL */
	
	/*
	 *	Sends an email
	 */
	public function send_email($recipient, $subject, $body)
	{
			
		$CI =& get_instance();

		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => $CI->get('email_host'),
			'smtp_port' => $CI->get('email_port'),
			'smtp_user' => $CI->get('email_username'),
			'smtp_pass' => $CI->get('email_password'),
		);
		
		$CI->load->library('email', $config);
		$CI->email->set_newline("\r\n");
		
		$CI->email->from($CI->get('email_from'), $CI->get('email_from_name'));
		$CI->email->to($recipient); 
		$CI->email->subject($subject);
		
		$CI->email->mailtype = "html";
		
		$body = "<HTML><HEAD></HEAD><BODY>".$body."</BODY></HTML>";
		
		$CI->email->message($body);	
		
		if(!$CI->email->send())
		{
			throw new Exception('<p> unable to send email. </p>');
		}

	}

	/*
	 *	Sends a mass email
	 */
	public function send_mass_email($subject, $body)
	{
			
		$CI =& get_instance();

		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => $CI->get('email_host'),
			'smtp_port' => $CI->get('email_port'),
			'smtp_user' => $CI->get('email_username'),
			'smtp_pass' => $CI->get('email_password'),
		);
		
		$CI->load->library('email', $config);
		$CI->email->set_newline("\r\n");
		
		$CI->email->from($CI->get('email_from'), $CI->get('email_from_name'));
		
		$bcc_list = array();

		$CI->load->model('users_model');
		
		foreach($CI->users_model->get_allowed_emails()->result() as $record)
		{
			array_push($bcc_list, $record->email);
		}
		
		$CI->email->bcc($bcc_list); 
	
		$CI->email->subject($subject);
		$CI->email->message($body);
		
		if(!$CI->email->send())
		{
			throw new Exception('<p> unable to send email. </p>');
		}

	}
	
	/* HELPERS */
	
	function get($name)
	{
		$CI =& get_instance();
		return $CI->settings_model->get_setting($name);
	}
	
	function set($name, $value)
	{
		$CI =& get_instance();
		return $CI->settings_model->set_setting($name, $value);
	}
	
}
