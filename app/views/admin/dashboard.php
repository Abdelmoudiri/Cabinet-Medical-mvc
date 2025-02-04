<div class="row mb-4">
    <div class="col">
        <h1>Tableau de bord administrateur</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Patients</h5>
                <h2 class="card-text"><?= $stats['total_patients'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Médecins</h5>
                <h2 class="card-text"><?= $stats['total_medecins'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">RDV du jour</h5>
                <h2 class="card-text"><?= $stats['rdv_jour'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">RDV en attente</h5>
                <h2 class="card-text"><?= $stats['rdv_attente'] ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Derniers rendez-vous</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Médecin</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($derniers_rdv as $rdv): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($rdv['date_heure'])) ?></td>
                                <td><?= $this->escape($rdv['patient_nom']) ?></td>
                                <td><?= $this->escape($rdv['medecin_nom']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $rdv['statut'] === 'confirmé' ? 'success' : 'warning' ?>">
                                        <?= ucfirst($rdv['statut']) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Journal d'activité</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>
                                <th>Utilisateur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($journal as $entry): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($entry['date_action'])) ?></td>
                                <td><?= $this->escape($entry['action']) ?></td>
                                <td><?= $this->escape($entry['user_name']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">État du système</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Base de données</h6>
                        <p class="text-success">
                            <i class="fas fa-check-circle"></i> Connectée
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h6>Espace disque</h6>
                        <p><?= $system_status['disk_usage'] ?> utilisé</p>
                    </div>
                    <div class="col-md-4">
                        <h6>Dernière sauvegarde</h6>
                        <p><?= $system_status['last_backup'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
