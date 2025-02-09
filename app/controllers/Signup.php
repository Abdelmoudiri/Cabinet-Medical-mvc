<?php 

/**
 * signup class
 */
class Signup
{
	use Controller;

	public function index()
	{
		$data = [];
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$user = new User;
			if($user->validate($_POST))
			{
				$_POST['id_role'] = $_POST['role'] === 'medcin' ? 1 : 2;
				$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
				
				unset($_POST['confirm-password']);
				
				$user->insert($_POST);
				redirect('login');
			}

			$data['errors'] = $user->errors;			
		}


		$this->view('signup',$data);
	}

}
