<?php 

class User
{
	
	use Model;

	protected $table = 'users';

	protected $allowedColumns = [

		'email',
		'password',
	];

	public function login($data)
	{
		
	}
	public function insert($data)
	{
		$this->query("insert into public.$this->table (email,password) values (:email,:password)",$data);

	}

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['email']))
		{
			$this->errors['email'] = "Email is required";
		}else
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}
		
		if(empty($data['password']))
		{
			$this->errors['password'] = "Password is required";
		}
		if(empty($data['confirm-password']))
		{
			$this->errors['password'] = "Password is required";
		}
		else {
			if($data['password'] != $data['confirm-password'])
			{
				$this->errors['password'] = "Password does not match";
			}
		}
		
		if(empty($data['name']))
		{
			$this->errors['terms'] = "name is required";
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
}