<?php

namespace App\Controllers;

use App\Models\Patient;
use Core\Security;

class PatientController {
    private $patientModel;

    public function __construct() {
        $this->patientModel = new Patient();
    }

    public function index() {
        $patients = $this->patientModel->getAll();
        require_once __DIR__ . '/../views/patients/index.php';
    }

    public function show($id) {
        $patient = $this->patientModel->getById($id);
        require_once __DIR__ . '/../views/patients/show.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = Security::sanitize($_POST);
            if ($this->patientModel->create($data)) {
                header('Location: /patients');
                exit;
            }
        }
        require_once __DIR__ . '/../views/patients/create.php';
    }
}
