<?php 

class User
{
	use Model;

	protected $table = 'users';

	protected $allowedColumns = [
		'nom',
		'prenom',
		'email',
		'password',
		'id_role',
		'role'
	];

	public function validate($data, $type = 'signup')
	{
		$this->errors = [];

		// Validation de l'email
		if(empty($data['email'])) {
			$this->errors['email'] = "L'email est requis";
		} else if($type === 'signup' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = "Format d'email invalide";
		}
		
		// Validation du mot de passe
		if(empty($data['password'])) {
			$this->errors['password'] = "Le mot de passe est requis";
		}

		// Validations spécifiques au signup
		if($type === 'signup')
		{
			// Validation de la confirmation du mot de passe
			if(empty($data['confirm-password'])) {
				$this->errors['confirm-password'] = "La confirmation du mot de passe est requise";
			} else if($data['password'] !== $data['confirm-password']) {
				$this->errors['confirm-password'] = "Les mots de passe ne correspondent pas";
			}
			
			// Validation du nom
			if(empty($data['nom'])) {
				$this->errors['nom'] = "Le nom est requis";
			}

			// Validation du prénom
			if(empty($data['prenom'])) {
				$this->errors['prenom'] = "Le prénom est requis";
			}

			return empty($this->errors);
		}
		
		// Validations spécifiques au login
		if($type === 'login')
		{
			if(empty($this->errors))
			{
				$arr['email'] = $data['email'];
				$row = $this->first($arr);
				
				if(!$row || !password_verify($data['password'], $row->password))
				{
					$this->errors['email'] = "Email ou mot de passe incorrect";
					return false;
				}

				return $row;
			}
		}

		return false;
	}
}