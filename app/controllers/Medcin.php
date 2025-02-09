<?php 

/**
 * login class
 */
class Medcin
{
	use Controller;

	public function index()
	{
        if(!isset($_SESSION['USER']) || $_SESSION['USER']->id_role != 1) {
            redirect('login');
        }

        $data['user'] = $_SESSION['USER'];
        
        $rdv = new RendezVous();
        $today_rdv = $rdv->getRdvMedecin($data['user']->id, date('Y-m-d'));
        $pending_rdv = $rdv->getRdvMedecin($data['user']->id, 'En Attente');
        $all_rdv = $rdv->getRdvMedecin($data['user']->id);

        $data['stats'] = (object)[
            'today_count' => is_array($today_rdv) ? count($today_rdv) : 0,
            'pending_count' => is_array($pending_rdv) ? count($pending_rdv) : 0,
            'total_patients' => is_array($all_rdv) ? count($all_rdv) : 0
        ];

        $status = $_GET['status'] ?? null;
        $data['rendezVous'] = $rdv->getRdvMedecin($data['user']->id, $status);
        if(!is_array($data['rendezVous'])) {
            $data['rendezVous'] = [];
        }

        $this->view('medcin', $data);
	}
	
	public function updateRdv()
    {
        if(!$_SERVER['REQUEST_METHOD'] == 'POST') {
            json(['success' => false]);
            return;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if(!isset($data->id) || !isset($data->status)) {
            json(['success' => false]);
            return;
        }

        $rdv = new RendezVous();
        $success = $rdv->updateStatus($data->id, $data->status);

        json(['success' => $success]);
    }
}
