<div class="row mb-4">
    <div class="col-md-8">
        <h1>Tableau de bord</h1>
    </div>
    <div class="col-md-4 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disponibiliteModal">
            Gérer mes disponibilités
        </button>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Rendez-vous aujourd'hui</h5>
                <h2 class="card-text"><?= $stats['rdv_jour'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Patients actifs</h5>
                <h2 class="card-text"><?= $stats['patients_actifs'] ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Consultations ce mois</h5>
                <h2 class="card-text"><?= $stats['consultations_mois'] ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Rendez-vous du jour</h5>
                <div class="btn-group">
                    <button class="btn btn-outline-secondary btn-sm" id="prevDay">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="currentDay">
                        Aujourd'hui
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="nextDay">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Heure</th>
                                <th>Patient</th>
                                <th>Motif</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rendez_vous as $rdv): ?>
                            <tr>
                                <td><?= date('H:i', strtotime($rdv['date_heure'])) ?></td>
                                <td>
                                    <a href="/medecin/patients/<?= $rdv['patient_id'] ?>">
                                        <?= $this->escape($rdv['patient_nom']) ?>
                                    </a>
                                </td>
                                <td><?= $this->escape($rdv['motif']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $rdv['statut'] === 'confirmé' ? 'success' : 'warning' ?>">
                                        <?= ucfirst($rdv['statut']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-primary" 
                                                onclick="demarrerConsultation(<?= $rdv['id'] ?>)">
                                            Démarrer
                                        </button>
                                        <button class="btn btn-sm btn-danger" 
                                                onclick="annulerRendezVous(<?= $rdv['id'] ?>)">
                                            Annuler
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Dernières consultations</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <?php foreach ($consultations as $consultation): ?>
                    <a href="/medecin/consultations/<?= $consultation['id'] ?>" 
                       class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1"><?= $this->escape($consultation['patient_nom']) ?></h6>
                            <small><?= date('d/m/Y', strtotime($consultation['date'])) ?></small>
                        </div>
                        <p class="mb-1"><?= $this->escape($consultation['motif']) ?></p>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Disponibilités -->
<div class="modal fade" id="disponibiliteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gérer mes disponibilités</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="disponibiliteForm">
                    <?= $this->csrf() ?>
                    <div class="mb-3">
                        <label class="form-label">Jour de la semaine</label>
                        <select name="jour" class="form-select" required>
                            <option value="1">Lundi</option>
                            <option value="2">Mardi</option>
                            <option value="3">Mercredi</option>
                            <option value="4">Jeudi</option>
                            <option value="5">Vendredi</option>
                            <option value="6">Samedi</option>
                            <option value="7">Dimanche</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Heure début</label>
                                <input type="time" name="heure_debut" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Heure fin</label>
                                <input type="time" name="heure_fin" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="sauvegarderDisponibilites()">
                    Sauvegarder
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function demarrerConsultation(id) {
    if (confirm('Voulez-vous démarrer cette consultation ?')) {
        window.location.href = `/medecin/consultations/demarrer/${id}`;
    }
}

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

function sauvegarderDisponibilites() {
    const form = document.getElementById('disponibiliteForm');
    const formData = new FormData(form);

    fetch('/api/medecin/disponibilites', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="csrf_token"]').value
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Erreur lors de la sauvegarde des disponibilités');
        }
    });
}
</script>
