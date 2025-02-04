<?php

namespace App\Models;

use Core\Database;
use PDO;

class User {
    // Assuming the User class has a constructor that initializes the database connection
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Assuming the User class has a validateData method
    protected function validateData($data) {
        // Validation logic for user data
    }
}

class Patient extends User {
    const ROLE = 'patient';
    
    protected $fillable = [
        'email', 
        'password', 
        'nom', 
        'prenom', 
        'telephone', 
        'date_naissance',
        'numero_securite_sociale',
        'groupe_sanguin',
        'allergies'
    ];

    public function getRendezVous() {
        $query = "SELECT rv.*, m.nom as medecin_nom, m.prenom as medecin_prenom 
                 FROM rendez_vous rv 
                 JOIN users m ON rv.medecin_id = m.id 
                 WHERE rv.patient_id = :patient_id 
                 ORDER BY rv.date_heure DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute(['patient_id' => $this->id]);
        return $stmt->fetchAll();
    }

    public function getHistoriqueMedical() {
        $query = "SELECT * FROM historique_medical 
                 WHERE patient_id = :patient_id 
                 ORDER BY date_consultation DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute(['patient_id' => $this->id]);
        return $stmt->fetchAll();
    }

    protected function validateData($data) {
        $errors = parent::validateData($data);

        if (!empty($data['numero_securite_sociale']) && 
            !preg_match("/^[12][0-9]{2}(0[1-9]|1[0-2])(2[AB]|[0-9]{2})[0-9]{8}$/", $data['numero_securite_sociale'])) {
            $errors['numero_securite_sociale'] = "Le numéro de sécurité sociale n'est pas valide";
        }

        if (!empty($data['groupe_sanguin']) && 
            !in_array($data['groupe_sanguin'], ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])) {
            $errors['groupe_sanguin'] = "Le groupe sanguin n'est pas valide";
        }

        return $errors;
    }
}
