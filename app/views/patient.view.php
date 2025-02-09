<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-semibold"><?=$data['user']->nom?> <?=$data['user']->prenom?></span>
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
                    Mes Rendez-vous
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <button onclick="showNewRdvModal()" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Nouveau rendez-vous
                </button>
            </div>
        </div>

        <!-- Liste des rendez-vous -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul role="list" class="divide-y divide-gray-200">
                <?php if(!empty($data['rendezVous'])): ?>
                    <?php foreach($data['rendezVous'] as $rdv): ?>
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">
                                                Dr. <?=$rdv->medecin_nom?> <?=$rdv->medecin_prenom?>
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                <?=$rdv->medecin_speciality?>
                                            </p>
                                        </div>
                                    </div>
                                    <div>
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
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Date: <?=date('d/m/Y', strtotime($rdv->date_rdv))?>
                                    </p>
                                </div>
                                <?php if($rdv->status_rdv != 'Annulé'): ?>
                                    <div class="mt-2">
                                        <button onclick="cancelRdv(<?=$rdv->id?>)" class="text-sm text-red-600 hover:text-red-900">
                                            Annuler le rendez-vous
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="px-4 py-4 sm:px-6">
                        <p class="text-sm text-gray-500 text-center">Aucun rendez-vous programmé</p>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Modal Nouveau Rendez-vous -->
    <div id="newRdvModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="newRdvForm" onsubmit="submitNewRdv(event)">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Nouveau rendez-vous
                                </h3>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <label for="medecin" class="block text-sm font-medium text-gray-700">Médecin</label>
                                        <select id="medecin" name="id_medecin" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option value="">Sélectionnez un médecin</option>
                                            <?php foreach($data['medecins'] as $medecin): ?>
                                                <option value="<?=$medecin->id?>">
                                                    Dr. <?=$medecin->nom?> <?=$medecin->prenom?> - <?=$medecin->speciality?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" name="date_rdv" id="date" required min="<?=date('Y-m-d')?>"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Prendre rendez-vous
                        </button>
                        <button type="button" onclick="hideNewRdvModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showNewRdvModal() {
            document.getElementById('newRdvModal').classList.remove('hidden');
        }

        function hideNewRdvModal() {
            document.getElementById('newRdvModal').classList.add('hidden');
        }

        function submitNewRdv(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            
            fetch('<?=ROOT?>/patient/createRdv', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id_medecin: formData.get('id_medecin'),
                    date_rdv: formData.get('date_rdv')
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Une erreur est survenue');
                }
            });
        }

        function cancelRdv(id) {
            if(confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')) {
                fetch('<?=ROOT?>/patient/cancelRdv', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: id })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        location.reload();
                    } else {
                        alert(data.message || 'Une erreur est survenue');
                    }
                });
            }
        }
    </script>
</body>
</html>
