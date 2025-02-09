<?php

/**
 * login class
 */
class Patient
{
    use Controller;

    public function index()
    {
        if(!isset($_SESSION['USER']) || $_SESSION['USER']->id_role != 2) {
            redirect('login');
        }

        $data['user'] = $_SESSION['USER'];
        
        $rdv = new RendezVous();
        $medecin = new InfosMedecin();

        $data['medecins'] = $medecin->getMedecinsWithInfos();
        if(!is_array($data['medecins'])) {
            $data['medecins'] = [];
        }

        $data['rendezVous'] = $rdv->getRdvPatient($data['user']->id);
        if(!is_array($data['rendezVous'])) {
            $data['rendezVous'] = [];
        }

        $this->view('patient', $data);
    }

    public function createRdv()
    {
        if(!$_SERVER['REQUEST_METHOD'] == 'POST') {
            json(['success' => false, 'message' => 'Méthode non autorisée']);
            return;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if(!isset($data->id_medecin) || !isset($data->date_rdv)) {
            json(['success' => false, 'message' => 'Données manquantes']);
            return;
        }

        $rdv = new RendezVous();
        $rdv_data = [
            'id_medecin' => $data->id_medecin,
            'id_patient' => $_SESSION['USER']->id,
            'date_rdv' => $data->date_rdv,
            'status_rdv' => 'En Attente'
        ];

        if(!$rdv->isCreneauDisponible($data->id_medecin, $data->date_rdv)) {
            json(['success' => false, 'message' => 'Ce créneau n\'est pas disponible']);
            return;
        }

        $success = $rdv->insert($rdv_data);
        if($success) {
            json(['success' => true]);
        } else {
            json(['success' => false, 'message' => 'Erreur lors de la création du rendez-vous']);
        }
    }

    public function cancelRdv()
    {
        if(!$_SERVER['REQUEST_METHOD'] == 'POST') {
            json(['success' => false]);
            return;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if(!isset($data->id)) {
            json(['success' => false]);
            return;
        }

        $rdv = new RendezVous();
        $rdv_info = $rdv->where('id', $data->id);
        
        if(!$rdv_info || $rdv_info[0]->id_patient != $_SESSION['USER']->id) {
            json(['success' => false, 'message' => 'Rendez-vous non trouvé']);
            return;
        }

        $success = $rdv->updateStatus($data->id, 'Annulé');
        json(['success' => $success]);
    }
}
