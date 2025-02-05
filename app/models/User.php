<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use Exception;

abstract class User
{
    protected $db;
    protected $table = 'users';

    protected $email;
    protected $password;
    protected $nom;
    protected $prenom;
    protected $telephone;
    protected $date_naissance;
    protected $role;

    const ROLE = 'user'; 

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function authenticate(string $email, string $password)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email AND role = :role";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'email' => $email,
            'role' => static::ROLE,
        ]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        throw new Exception("Email ou mot de passe incorrect.");
    }

    public function create(array $data)
    {
        $errors = $this->validateData($data);
        if ($errors) {
            throw new Exception("Erreur de validation des données.");
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $data['role'] = static::ROLE;

        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($query);

        if ($stmt->execute($data)) {
            return true;
        }

        throw new Exception("Erreur lors de la création de l'utilisateur.");
    }

    public function findByEmail(string $email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email AND role = :role";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'email' => $email,
            'role' => static::ROLE,
        ]);

        return $stmt->fetch();
    }

    protected function validateData(array $data): array
    {
        $errors = [];

        if (empty($data['email'])) {
            $errors['email'] = "L'email est obligatoire";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'email n'est pas valide";
        }

        if (empty($data['nom'])) {
            $errors['nom'] = "Le nom est obligatoire";
        }

        if (empty($data['prenom'])) {
            $errors['prenom'] = "Le prénom est obligatoire";
        }

        if (!empty($data['telephone']) && !preg_match("/^[0-9]{10}$/", $data['telephone'])) {
            $errors['telephone'] = "Le numéro de téléphone n'est pas valide";
        }

        if (!empty($data['date_naissance'])) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['date_naissance']);
            if (!$date || $date->format('Y-m-d') !== $data['date_naissance']) {
                $errors['date_naissance'] = "La date de naissance n'est pas valide";
            }
        }

        return $errors;
    }
}
