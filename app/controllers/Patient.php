<?php 

/**
 * login class
 */
class Patient
{
	use Controller;

	public function index()
	{

		$data['username'] = empty($_SESSION['USER']) ? 'User':$_SESSION['USER']->email;

		$this->view('patient',$data);
	}
}
