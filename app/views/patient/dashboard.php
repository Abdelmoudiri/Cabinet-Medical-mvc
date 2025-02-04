<div class="row mb-4">
    <div class="col-md-8">
        <h1>Mon espace patient</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="/patient/rendez-vous/nouveau" class="btn btn-primary">
            Prendre rendez-vous
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Prochain rendez-vous</h5>
                <?php if ($prochain_rdv): ?>
                    <p class="mb-0">
                        Le <?= date('d/m/Y à H:i', strtotime($prochain_rdv['date_heure'])) ?><br>
                        avec Dr. <?= $this->escape($prochain_rdv['medecin_nom']) ?>
                    </p>
                <?php else: ?>
                    <p class="mb-0">Aucun rendez-vous prévu</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Documents</h5>
                <p class="mb-0">
                    <?= $stats['documents'] ?> document(s) disponible(s)
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Dernière visite</h5>
                <?php if ($derniere_visite): ?>
                    <p class="mb-0">
                        Le <?= date('d/m/Y', strtotime($derniere_visite['date'])) ?>
                    </p>
                <?php else: ?>
                    <p class="mb-0">Aucune visite</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Mes prochains rendez-vous</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($rendez_vous)): ?>
                    <div class="list-group">
                        <?php foreach ($rendez_vous as $rdv): ?>
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">
                                        Dr. <?= $this->escape($rdv['medecin_nom']) ?>
                                    </h6>
                                    <small class="text-muted">
                                        <?= date('d/m/Y H:i', strtotime($rdv['date_heure'])) ?>
                                    </small>
                                </div>
                                <p class="mb-1"><?= $this->escape($rdv['motif']) ?></p>
                                <div class="mt-2">
                                    <?php if ($rdv['statut'] === 'en_attente'): ?>
                                        <button class="btn btn-sm btn-danger" 
                                                onclick="annulerRendezVous(<?= $rdv['id'] ?>)">
                                            Annuler
                                        </button>
                                    <?php else: ?>
                                        <span class="badge bg-success">Confirmé</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0">Aucun rendez-vous prévu</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Mes derniers documents</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($documents)): ?>
                    <div class="list-group">
                        <?php foreach ($documents as $doc): ?>
                            <a href="/patient/documents/<?= $doc['id'] ?>" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1"><?= $this->escape($doc['titre']) ?></h6>
                                    <small class="text-muted">
                                        <?= date('d/m/Y', strtotime($doc['date'])) ?>
                                    </small>
                                </div>
                                <p class="mb-1"><?= $this->escape($doc['type']) ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0">Aucun document disponible</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Mon dossier médical</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informations personnelles</h6>
                        <table class="table table-sm">
                            <tr>
                                <th>Groupe sanguin :</th>
                                <td><?= $this->escape($patient['groupe_sanguin']) ?></td>
                            </tr>
                            <tr>
                                <th>Allergies :</th>
                                <td><?= $this->escape($patient['allergies']) ?></td>
                            </tr>
                            <tr>
                                <th>Numéro de sécurité sociale :</th>
                                <td><?= $this->escape($patient['numero_securite_sociale']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Antécédents médicaux</h6>
                        <?php if (!empty($antecedents)): ?>
                            <ul class="list-unstyled">
                                <?php foreach ($antecedents as $antecedent): ?>
                                    <li>
                                        <i class="fas fa-circle fa-xs me-2"></i>
                                        <?= $this->escape($antecedent['description']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">Aucun antécédent médical enregistré</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function annulerRendezVous(id) {
    if (confirm('Voulez-vous vraiment annuler ce rendez-vous ?')) {
        fetch(`/api/rendez-vous/${id}/annuler`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="csrf_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de l\'annulation du rendez-vous');
            }
        });
    }
}
</script>
