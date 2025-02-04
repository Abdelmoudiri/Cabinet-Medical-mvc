<div class="row mb-4">
    <div class="col">
        <h1>Mon historique médical</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#consultations">
                            Consultations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#prescriptions">
                            Prescriptions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#documents">
                            Documents médicaux
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Onglet Consultations -->
                    <div class="tab-pane fade show active" id="consultations">
                        <?php if (!empty($consultations)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Médecin</th>
                                            <th>Motif</th>
                                            <th>Diagnostic</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($consultations as $consultation): ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($consultation['date'])) ?></td>
                                                <td>Dr. <?= $this->escape($consultation['medecin_nom']) ?></td>
                                                <td><?= $this->escape($consultation['motif']) ?></td>
                                                <td><?= $this->escape($consultation['diagnostic']) ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-info" 
                                                            onclick="voirDetail(<?= $consultation['id'] ?>)">
                                                        Détails
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Aucune consultation enregistrée</p>
                        <?php endif; ?>
                    </div>

                    <!-- Onglet Prescriptions -->
                    <div class="tab-pane fade" id="prescriptions">
                        <?php if (!empty($prescriptions)): ?>
                            <div class="accordion" id="accordionPrescriptions">
                                <?php foreach ($prescriptions as $prescription): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#prescription<?= $prescription['id'] ?>">
                                                Prescription du <?= date('d/m/Y', strtotime($prescription['date'])) ?>
                                                - Dr. <?= $this->escape($prescription['medecin_nom']) ?>
                                            </button>
                                        </h2>
                                        <div id="prescription<?= $prescription['id'] ?>" 
                                             class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Médicament</th>
                                                            <th>Posologie</th>
                                                            <th>Durée</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($prescription['medicaments'] as $medicament): ?>
                                                            <tr>
                                                                <td><?= $this->escape($medicament['nom']) ?></td>
                                                                <td><?= $this->escape($medicament['posologie']) ?></td>
                                                                <td><?= $this->escape($medicament['duree']) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <div class="mt-3">
                                                    <a href="/patient/prescriptions/<?= $prescription['id'] ?>/pdf" 
                                                       class="btn btn-sm btn-primary">
                                                        Télécharger l'ordonnance
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Aucune prescription enregistrée</p>
                        <?php endif; ?>
                    </div>

                    <!-- Onglet Documents -->
                    <div class="tab-pane fade" id="documents">
                        <?php if (!empty($documents)): ?>
                            <div class="row">
                                <?php foreach ($documents as $document): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <?= $this->escape($document['titre']) ?>
                                                </h6>
                                                <p class="card-text">
                                                    Type: <?= $this->escape($document['type']) ?><br>
                                                    Date: <?= date('d/m/Y', strtotime($document['date'])) ?>
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="/patient/documents/<?= $document['id'] ?>" 
                                                   class="btn btn-sm btn-primary">
                                                    Télécharger
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Aucun document médical enregistré</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Détail Consultation -->
<div class="modal fade" id="modalConsultation" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détail de la consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Le contenu sera chargé dynamiquement -->
            </div>
        </div>
    </div>
</div>

<script>
function voirDetail(consultationId) {
    const modal = new bootstrap.Modal(document.getElementById('modalConsultation'));
    const modalBody = document.querySelector('#modalConsultation .modal-body');
    
    fetch(`/api/consultations/${consultationId}`)
        .then(response => response.json())
        .then(data => {
            modalBody.innerHTML = `
                <div class="mb-4">
                    <h6>Informations générales</h6>
                    <table class="table table-sm">
                        <tr>
                            <th>Date :</th>
                            <td>${new Date(data.date).toLocaleDateString()}</td>
                        </tr>
                        <tr>
                            <th>Médecin :</th>
                            <td>Dr. ${data.medecin_nom}</td>
                        </tr>
                        <tr>
                            <th>Motif :</th>
                            <td>${data.motif}</td>
                        </tr>
                    </table>
                </div>
                <div class="mb-4">
                    <h6>Diagnostic</h6>
                    <p>${data.diagnostic}</p>
                </div>
                <div class="mb-4">
                    <h6>Notes</h6>
                    <p>${data.notes}</p>
                </div>
                ${data.prescriptions ? `
                    <div>
                        <h6>Prescriptions</h6>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Médicament</th>
                                    <th>Posologie</th>
                                    <th>Durée</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.prescriptions.map(p => `
                                    <tr>
                                        <td>${p.medicament}</td>
                                        <td>${p.posologie}</td>
                                        <td>${p.duree}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                ` : ''}
            `;
            modal.show();
        });
}
</script>
