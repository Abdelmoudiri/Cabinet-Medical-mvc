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
		'date_creation'
	];

	public function validate($data, $type = 'signup')
	{
		$this->errors = [];

		if($type === 'signup') {
			// Validation du nom
			if(empty($data['nom'])) {
				$this->errors['nom'] = "Le nom est requis";
			}

			// Validation du prénom
			if(empty($data['prenom'])) {
				$this->errors['prenom'] = "Le prénom est requis";
			}

			// Validation de la confirmation du mot de passe
			if(empty($data['confirm-password'])) {
				$this->errors['confirm-password'] = "La confirmation du mot de passe est requise";
			} else if($data['password'] !== $data['confirm-password']) {
				$this->errors['confirm-password'] = "Les mots de passe ne correspondent pas";
			}
		}

		// Validation de l'email pour inscription et connexion
		if(empty($data['email'])) {
			$this->errors['email'] = "L'email est requis";
		} else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = "L'email n'est pas valide";
		}

		// Vérifier si l'email existe déjà uniquement pour l'inscription
		if($type === 'signup') {
			$query = "SELECT id FROM users WHERE email = :email LIMIT 1";
			$email_check = $this->query($query, ['email' => $data['email']]);
			if($email_check) {
				$this->errors['email'] = "Cet email est déjà utilisé";
			}
		}

		// Validation du mot de passe
		if(empty($data['password'])) {
			$this->errors['password'] = "Le mot de passe est requis";
		} else if($type === 'signup' && strlen($data['password']) < 8) {
			$this->errors['password'] = "Le mot de passe doit contenir au moins 8 caractères";
		}

		if($type === 'login' && empty($this->errors)) {
			// Vérifier les identifiants pour la connexion
			$query = "SELECT * FROM users WHERE email = :email LIMIT 1";
			$row = $this->query($query, ['email' => $data['email']]);
			
			if(!$row || !password_verify($data['password'], $row[0]->password)) {
				$this->errors['email'] = "Email ou mot de passe incorrect";
				return false;
			}
			return $row[0];
		}

		return empty($this->errors);
	}
}