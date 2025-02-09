<?php 

/**
 * login class
 */
class Login
{
	use Controller;

	public function index()
	{
		$data = [];
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$user = new User;
			$data['errors'] = [];

			
			$row = $user->validate($_POST, 'login');
			
			if($row)
			{
				$_SESSION['USER'] = $row;
				
				if($row->id_role == 1) {
					redirect('medcin');
				} else {
					redirect('patient');
				}
			}

			$data['errors'] = $user->errors;
		}

		$this->view('login', $data);
	}
}
