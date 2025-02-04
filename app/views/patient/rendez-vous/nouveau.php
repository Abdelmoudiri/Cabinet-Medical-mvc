<div class="row mb-4">
    <div class="col">
        <h1>Prendre un rendez-vous</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form id="rdvForm" method="POST" action="/patient/rendez-vous/nouveau">
                    <?= $this->csrf() ?>
                    
                    <div class="mb-3">
                        <label for="medecin" class="form-label">Médecin</label>
                        <select class="form-select" id="medecin" name="medecin_id" required>
                            <option value="">Choisir un médecin</option>
                            <?php foreach ($medecins as $medecin): ?>
                                <option value="<?= $medecin['id'] ?>">
                                    Dr. <?= $this->escape($medecin['nom']) ?> <?= $this->escape($medecin['prenom']) ?> 
                                    - <?= $this->escape($medecin['specialite']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="motif" class="form-label">Motif de la consultation</label>
                        <select class="form-select" id="motif" name="motif" required>
                            <option value="">Choisir un motif</option>
                            <option value="consultation">Consultation générale</option>
                            <option value="suivi">Suivi médical</option>
                            <option value="urgence">Urgence</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>

                    <div id="autreMotif" class="mb-3" style="display: none;">
                        <label for="motif_detail" class="form-label">Précisez le motif</label>
                        <textarea class="form-control" id="motif_detail" name="motif_detail" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date souhaitée</label>
                        <input type="date" class="form-control" id="date" name="date" required 
                               min="<?= date('Y-m-d') ?>">
                    </div>

                    <div id="creneauxDisponibles" class="mb-3" style="display: none;">
                        <label class="form-label">Créneaux disponibles</label>
                        <div class="btn-group-vertical w-100" id="creneauxButtons">
                            <!-- Les créneaux seront ajoutés dynamiquement ici -->
                        </div>
                    </div>

                    <input type="hidden" name="creneau" id="creneau">
                    
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire (optionnel)</label>
                        <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="rappel" name="rappel" checked>
                        <label class="form-check-label" for="rappel">
                            Je souhaite recevoir un rappel par email 24h avant le rendez-vous
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary" id="btnConfirmer" disabled>
                        Confirmer le rendez-vous
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Informations</h5>
            </div>
            <div class="card-body">
                <h6>Horaires d'ouverture</h6>
                <ul class="list-unstyled">
                    <li>Lundi - Vendredi : 8h00 - 19h00</li>
                    <li>Samedi : 9h00 - 12h00</li>
                    <li>Dimanche : Fermé</li>
                </ul>

                <h6 class="mt-4">En cas d'urgence</h6>
                <p>Pour toute urgence en dehors des heures d'ouverture, veuillez contacter :</p>
                <ul class="list-unstyled">
                    <li>SAMU : 15</li>
                    <li>Pompiers : 18</li>
                    <li>Numéro d'urgence européen : 112</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const motifSelect = document.getElementById('motif');
    const autreMotifDiv = document.getElementById('autreMotif');
    const medecinSelect = document.getElementById('medecin');
    const dateInput = document.getElementById('date');
    const creneauxDiv = document.getElementById('creneauxDisponibles');
    const creneauxButtons = document.getElementById('creneauxButtons');
    const creneauInput = document.getElementById('creneau');
    const btnConfirmer = document.getElementById('btnConfirmer');

    motifSelect.addEventListener('change', function() {
        autreMotifDiv.style.display = this.value === 'autre' ? 'block' : 'none';
    });

    function chargerCreneaux() {
        const medecinId = medecinSelect.value;
        const date = dateInput.value;

        if (!medecinId || !date) return;

        fetch(`/api/medecin/${medecinId}/creneaux?date=${date}`)
            .then(response => response.json())
            .then(data => {
                creneauxButtons.innerHTML = '';
                
                if (data.creneaux.length === 0) {
                    creneauxButtons.innerHTML = '<p class="text-muted">Aucun créneau disponible pour cette date</p>';
                    return;
                }

                data.creneaux.forEach(creneau => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn btn-outline-primary mb-2';
                    btn.textContent = creneau.heure;
                    btn.onclick = function() {
                        document.querySelectorAll('#creneauxButtons .btn').forEach(b => {
                            b.classList.remove('active');
                        });
                        btn.classList.add('active');
                        creneauInput.value = creneau.id;
                        btnConfirmer.disabled = false;
                    };
                    creneauxButtons.appendChild(btn);
                });

                creneauxDiv.style.display = 'block';
            });
    }

    medecinSelect.addEventListener('change', chargerCreneaux);
    dateInput.addEventListener('change', chargerCreneaux);

    // Définir la date minimale
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];
});
</script>
