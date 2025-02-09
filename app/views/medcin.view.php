<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Médecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-semibold">Dr. <?=$data['user']->nom?> <?=$data['user']->prenom?></span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="<?=ROOT?>/logout" class="text-gray-700 hover:text-red-500">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- En-tête du tableau de bord -->
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Tableau de bord
                </h2>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-6">
            <!-- Rendez-vous aujourd'hui -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Rendez-vous aujourd'hui
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        <?=$data['stats']->today_count?>
                    </dd>
                </div>
            </div>

            <!-- En attente -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        En attente
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        <?=$data['stats']->pending_count?>
                    </dd>
                </div>
            </div>

            <!-- Total patients -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Total patients
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        <?=$data['stats']->total_patients?>
                    </dd>
                </div>
            </div>
        </div>

        <!-- Liste des rendez-vous -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Rendez-vous à venir
                </h3>
                <div>
                    <select onchange="window.location.href='<?=ROOT?>/medcin?status=' + this.value" class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Tous les statuts</option>
                        <option value="En Attente" <?=isset($_GET['status']) && $_GET['status'] == 'En Attente' ? 'selected' : ''?>>En attente</option>
                        <option value="Confirmé" <?=isset($_GET['status']) && $_GET['status'] == 'Confirmé' ? 'selected' : ''?>>Confirmé</option>
                        <option value="Annulé" <?=isset($_GET['status']) && $_GET['status'] == 'Annulé' ? 'selected' : ''?>>Annulé</option>
                    </select>
                </div>
            </div>
            <ul role="list" class="divide-y divide-gray-200">
                <?php if(!empty($data['rendezVous'])): ?>
                    <?php foreach($data['rendezVous'] as $rdv): ?>
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">
                                                <?=$rdv->patient_nom?> <?=$rdv->patient_prenom?>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                Date: <?=date('d/m/Y', strtotime($rdv->date_rdv))?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            <?php
                                            switch($rdv->status_rdv) {
                                                case 'Confirmé':
                                                    echo 'bg-green-100 text-green-800';
                                                    break;
                                                case 'En Attente':
                                                    echo 'bg-yellow-100 text-yellow-800';
                                                    break;
                                                case 'Annulé':
                                                    echo 'bg-red-100 text-red-800';
                                                    break;
                                            }
                                            ?>">
                                            <?=$rdv->status_rdv?>
                                        </span>
                                        <?php if($rdv->status_rdv == 'En Attente'): ?>
                                            <button onclick="updateRdvStatus(<?=$rdv->id?>, 'Confirmé')" class="text-sm text-green-600 hover:text-green-900">
                                                Confirmer
                                            </button>
                                            <button onclick="updateRdvStatus(<?=$rdv->id?>, 'Annulé')" class="text-sm text-red-600 hover:text-red-900">
                                                Annuler
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="px-4 py-4 sm:px-6">
                        <p class="text-sm text-gray-500 text-center">Aucun rendez-vous trouvé</p>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <script>
        function updateRdvStatus(id, status) {
            if(confirm('Êtes-vous sûr de vouloir ' + (status === 'Confirmé' ? 'confirmer' : 'annuler') + ' ce rendez-vous ?')) {
                fetch('<?=ROOT?>/medcin/updateRdv', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: id, status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        location.reload();
                    } else {
                        alert('Une erreur est survenue');
                    }
                });
            }
        }
    </script>
</body>
</html>
