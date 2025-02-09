<?php

class InfosMedecin
{
    use Model;

    protected $table = 'infos_medecin';
    protected $allowedColumns = ['id_user', 'speciality', 'experience'];

    public function getMedecinsWithInfos()
    {
        $query = "SELECT u.id, u.nom, u.prenom, im.speciality, im.experience 
                 FROM users u 
                 JOIN infos_medecin im ON u.id = im.id_user 
                 WHERE u.id_role = 1 
                 ORDER BY u.nom, u.prenom";

        return $this->query($query);
    }

    public function getMedecinsBySpeciality($speciality)
    {
        $query = "SELECT u.id, u.nom, u.prenom, im.speciality, im.experience 
                 FROM users u 
                 JOIN infos_medecin im ON u.id = im.id_user 
                 WHERE u.id_role = 1 
                 AND im.speciality = :speciality 
                 ORDER BY u.nom, u.prenom";

        return $this->query($query, ['speciality' => $speciality]);
    }

    public function getMedecinInfo($id_medecin)
    {
        $query = "SELECT u.id, u.nom, u.prenom, u.email, im.speciality, im.experience 
                 FROM users u 
                 JOIN infos_medecin im ON u.id = im.id_user 
                 WHERE u.id = :id_medecin 
                 AND u.id_role = 1 
                 LIMIT 1";

        $result = $this->query($query, ['id_medecin' => $id_medecin]);
        return $result ? $result[0] : false;
    }

    public function updateMedecinInfo($id_medecin, $data)
    {
        if(!isset($data['speciality']) || !isset($data['experience'])) {
            return false;
        }

        $query = "UPDATE infos_medecin 
                 SET speciality = :speciality, 
                     experience = :experience 
                 WHERE id_user = :id_medecin";

        return $this->query($query, [
            'id_medecin' => $id_medecin,
            'speciality' => $data['speciality'],
            'experience' => $data['experience']
        ]);
    }

    public function getSpecialities()
    {
        $query = "SELECT DISTINCT speciality 
                 FROM infos_medecin 
                 ORDER BY speciality";

        $result = $this->query($query);
        return array_map(function($item) {
            return $item->speciality;
        }, $result);
    }
}
