<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation
{
	
	public function validate($data, $rules)
	{
		foreach ($data as $data_key => $data_value)
		{
			foreach ($rules[$data_key] as $rule)
			{
				
				$message = $this->$rule($data_value);
				
				if($message)
				{
					return str_replace('#field', $data_key, $message);
				}				
				
			}
		}
	}
	
	public function not_empty($value)
	{
		if (!isset($value) || $value == '')
		{
      return '#field cannot be empty';
		}
	}

  public function username($username)
	{
    
		// Search user
		$CI =& get_instance();
		$CI->load->model('user_model');
    $user = $CI->user_model->find(Array('username'=>$username));
    
    if($user) 
		{
      return '#field already exists';
    }
    
		return null;
		
  }

  public function password($password)
	{
    
    if(strlen($password) < 8) 
		{
      return '#field too short';
    }
    if (preg_match_all( "/[0-9]/", $password ) < 1)
		{
			return '#field requires at least 1 digit';
		}
		
		return null;
		
  }

  public function zipcode($zipcode) 
	{
    
		if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $zipcode))
		{
      return 'Invalid #field';
    }
    
		return FALSE;
		
  }
  
  public function email($email) 
	{
    
		if(!preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email))
		{
      return 'Invalid #field';
    }
    
		return null;
		
  }
	
	public function gender($gender)
	{
		return null;
	}
	
}
