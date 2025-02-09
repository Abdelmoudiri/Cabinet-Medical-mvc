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
            $data['errors'] = [];

            // Valider les données
            $user->validate($_POST);
            
            if(empty($user->errors))
            {
                $arr['nom'] = $_POST['nom'];
                $arr['prenom'] = $_POST['prenom'];
                $arr['email'] = $_POST['email'];
                $arr['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $arr['id_role'] = $_POST['role'] === 'medcin' ? 1 : 2;

                $user->insert($arr);
                
                redirect('login');
            }

            $data['errors'] = $user->errors;
        }

        $this->view('signup', $data);
    }

}
