<?php

namespace App\Models;

class Admin extends User {
    const ROLE = 'admin';
    
    protected $fillable = [
        'email', 
        'password', 
        'nom', 
        'prenom', 
        'telephone'
    ];

    public function getStatistiques($debut = null, $fin = null) {
        if ($debut === null) {
            $debut = date('Y-m-d', strtotime('-30 days'));
        }
        if ($fin === null) {
            $fin = date('Y-m-d');
        }

        $stats = [];

        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'patient'";
        $stmt = $this->db->query($query);
        $stats['total_patients'] = $stmt->fetch()['total'];

        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'medecin'";
        $stmt = $this->db->query($query);
        $stats['total_medecins'] = $stmt->fetch()['total'];

        $query = "SELECT COUNT(*) as total FROM rendez_vous 
                 WHERE DATE(date_heure) BETWEEN :debut AND :fin";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['debut' => $debut, 'fin' => $fin]);
        $stats['total_rendez_vous'] = $stmt->fetch()['total'];

        $query = "SELECT m.nom, m.prenom, COUNT(rv.id) as total_rdv 
                 FROM users m 
                 LEFT JOIN rendez_vous rv ON m.id = rv.medecin_id 
                 AND DATE(rv.date_heure) BETWEEN :debut AND :fin 
                 WHERE m.role = 'medecin' 
                 GROUP BY m.id, m.nom, m.prenom";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['debut' => $debut, 'fin' => $fin]);
        $stats['stats_par_medecin'] = $stmt->fetchAll();

        return $stats;
    }

    public function getJournal($limite = 100) {
        $query = "SELECT * FROM journal_activites 
                 ORDER BY date_action DESC 
                 LIMIT :limite";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limite', $limite, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ajouterEntreeJournal($action, $description, $userId = null) {
        $query = "INSERT INTO journal_activites (action, description, user_id, date_action) 
                 VALUES (:action, :description, :user_id, CURRENT_TIMESTAMP)";
        
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'action' => $action,
            'description' => $description,
            'user_id' => $userId
        ]);
    }

    public function verifierConfiguration() {
        $erreurs = [];
        
        try {
            $this->db->query("SELECT 1");
        } catch (\Exception $e) {
            $erreurs['database'] = "Erreur de connexion à la base de données: " . $e->getMessage();
        }
        
        $dossiers = ['logs', 'uploads'];
        foreach ($dossiers as $dossier) {
            if (!is_writable(__DIR__ . '/../../' . $dossier)) {
                $erreurs[$dossier] = "Le dossier {$dossier} n'est pas accessible en écriture";
            }
        }
        
        $extensions = ['pdo', 'pdo_pgsql', 'json', 'mbstring'];
        foreach ($extensions as $extension) {
            if (!extension_loaded($extension)) {
                $erreurs['extensions'][] = "L'extension PHP {$extension} n'est pas installée";
            }
        }
        
        return $erreurs;
    }

    protected function validateData($data) {
        return parent::validateData($data);
    }
}
