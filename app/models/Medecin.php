<?php

namespace App\Models;

class Medecin extends User {
    const ROLE = 'medecin';
    
    protected $fillable = [
        'email', 
        'password', 
        'nom', 
        'prenom', 
        'telephone', 
        'date_naissance',
        'numero_rpps',
        'specialite',
        'disponibilites'
    ];

    public function getRendezVousDuJour($date = null) {
        if ($date === null) {
            $date = date('Y-m-d');
        }

        $query = "SELECT rv.*, p.nom as patient_nom, p.prenom as patient_prenom 
                 FROM rendez_vous rv 
                 JOIN users p ON rv.patient_id = p.id 
                 WHERE rv.medecin_id = :medecin_id 
                 AND DATE(rv.date_heure) = :date 
                 ORDER BY rv.date_heure ASC";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'medecin_id' => $this->id,
            'date' => $date
        ]);
        return $stmt->fetchAll();
    }

    public function getDisponibilites() {
        $query = "SELECT * FROM disponibilites 
                 WHERE medecin_id = :medecin_id 
                 ORDER BY jour_semaine, heure_debut";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute(['medecin_id' => $this->id]);
        return $stmt->fetchAll();
    }

    public function setDisponibilite($jourSemaine, $heureDebut, $heureFin) {
        $query = "INSERT INTO disponibilites (medecin_id, jour_semaine, heure_debut, heure_fin) 
                 VALUES (:medecin_id, :jour_semaine, :heure_debut, :heure_fin)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'medecin_id' => $this->id,
            'jour_semaine' => $jourSemaine,
            'heure_debut' => $heureDebut,
            'heure_fin' => $heureFin
        ]);
    }

    public function ajouterConsultation($patientId, $notes, $prescriptions = null) {
        $this->db->beginTransaction();
        
        try {
            $query = "INSERT INTO consultations (medecin_id, patient_id, date_consultation, notes) 
                     VALUES (:medecin_id, :patient_id, CURRENT_TIMESTAMP, :notes)";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'medecin_id' => $this->id,
                'patient_id' => $patientId,
                'notes' => $notes
            ]);
            
            $consultationId = $this->db->lastInsertId();
            
            if ($prescriptions) {
                $query = "INSERT INTO prescriptions (consultation_id, medicament, posologie, duree) 
                         VALUES (:consultation_id, :medicament, :posologie, :duree)";
                
                $stmt = $this->db->prepare($query);
                foreach ($prescriptions as $prescription) {
                    $prescription['consultation_id'] = $consultationId;
                    $stmt->execute($prescription);
                }
            }
            
            $this->db->commit();
            return $consultationId;
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    protected function validateData($data) {
        $errors = parent::validateData($data);

        if (!empty($data['numero_rpps']) && !preg_match("/^[0-9]{11}$/", $data['numero_rpps'])) {
            $errors['numero_rpps'] = "Le numéro RPPS n'est pas valide";
        }

        if (empty($data['specialite'])) {
            $errors['specialite'] = "La spécialité est obligatoire";
        }

        return $errors;
    }
}
