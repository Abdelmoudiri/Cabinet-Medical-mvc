<?php

class RendezVous
{
    use Model;

    protected $table = 'rendez_vous';
    protected $allowedColumns = [
        'id_medecin',
        'id_patient',
        'date_rdv',
        'status_rdv',
        'date_creation'
    ];

    public function getRdvMedecin($id_medecin)
    {
        $query = "SELECT rv.*, 
                        p.nom as patient_nom, 
                        p.prenom as patient_prenom,
                        m.nom as medecin_nom,
                        m.prenom as medecin_prenom,
                        m.email as medecin_email,
                        im.speciality
                 FROM rendez_vous rv 
                 JOIN users p ON rv.id_patient = p.id 
                 JOIN users m ON rv.id_medecin = m.id 
                 LEFT JOIN infos_medecin im ON m.id = im.id_user
                 WHERE rv.id_medecin = :id_medecin 
                 ORDER BY rv.date_rdv DESC";

        return $this->query($query, ['id_medecin' => $id_medecin]);
    }

    public function getRdvPatient($id_patient)
    {
        $query = "SELECT rv.*, 
                        p.nom as patient_nom, 
                        p.prenom as patient_prenom,
                        m.nom as medecin_nom,
                        m.prenom as medecin_prenom,
                        m.email as medecin_email,
                        im.speciality
                 FROM rendez_vous rv 
                 JOIN users p ON rv.id_patient = p.id 
                 JOIN users m ON rv.id_medecin = m.id 
                 LEFT JOIN infos_medecin im ON m.id = im.id_user
                 WHERE rv.id_patient = :id_patient 
                 ORDER BY rv.date_rdv DESC";

        return $this->query($query, ['id_patient' => $id_patient]);
    }

    public function getRdvDuJour($id_medecin)
    {
        $query = "SELECT rv.*, 
                        p.nom as patient_nom, 
                        p.prenom as patient_prenom
                 FROM rendez_vous rv 
                 JOIN users p ON rv.id_patient = p.id 
                 WHERE rv.id_medecin = :id_medecin 
                 AND DATE(rv.date_rdv) = CURDATE()
                 AND rv.status_rdv = 'Confirmé'
                 ORDER BY rv.date_rdv ASC";

        return $this->query($query, ['id_medecin' => $id_medecin]);
    }

    public function updateStatus($id_rdv, $status)
    {
        $query = "UPDATE rendez_vous 
                 SET status_rdv = :status 
                 WHERE id = :id_rdv";

        return $this->query($query, [
            'id_rdv' => $id_rdv,
            'status' => $status
        ]);
    }

    public function isCreneauDisponible($id_medecin, $date_rdv)
    {
        $query = "SELECT COUNT(*) as count 
                 FROM rendez_vous 
                 WHERE id_medecin = :id_medecin 
                 AND date_rdv = :date_rdv 
                 AND status_rdv != 'Annulé'";

        $result = $this->query($query, [
            'id_medecin' => $id_medecin,
            'date_rdv' => $date_rdv
        ]);

        return $result[0]->count == 0;
    }

    public function getStatsMedecin($id_medecin)
    {
        $query = "SELECT 
                    COUNT(*) as total_rdv,
                    SUM(CASE WHEN status_rdv = 'En Attente' THEN 1 ELSE 0 END) as rdv_en_attente,
                    SUM(CASE WHEN status_rdv = 'Confirmé' THEN 1 ELSE 0 END) as rdv_confirmes,
                    SUM(CASE WHEN status_rdv = 'Annulé' THEN 1 ELSE 0 END) as rdv_annules,
                    COUNT(DISTINCT id_patient) as total_patients
                 FROM rendez_vous 
                 WHERE id_medecin = :id_medecin";

        $result = $this->query($query, ['id_medecin' => $id_medecin]);
        return $result[0];
    }
}
