<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Médecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Bienvenue, Médecin</h1>
            <form method="POST" action="<?=ROOT?>/logout">
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Déconnexion
                </button>
            </form>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex space-x-4">
                <button id="tab-appointments" class="px-3 py-2 text-blue-600 border-b-2 border-blue-600">
                    Mes Rendez-vous
                </button>
                <button id="tab-availability" class="px-3 py-2 text-gray-500">
                    Disponibilité
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4">
        <!-- Appointments Tab -->
        <div id="appointments-tab" class="bg-white shadow rounded-lg">
            <div class="px-4 py-5">
                <h2 class="text-lg font-semibold mb-4">Mes Rendez-vous</h2>
                <div id="appointments-list">
                    <?php foreach ($appointments as $appointment): ?>
                        <div class="border rounded p-4 flex justify-between items-center">
                            <div>
                                <p class="font-semibold">Patient : <?= $appointment['patient_name']; ?></p>
                                <p class="text-gray-500">Date : <?= $appointment['date']; ?> | Heure : <?= $appointment['time']; ?></p>
                            </div>
                            <div>
                                <form method="POST" action="update_appointment_status.php">
                                    <input type="hidden" name="appointment_id" value="<?= $appointment['id']; ?>">
                                    <select name="status" class="border p-2 rounded">
                                        <option value="confirmed" <?= $appointment['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmé</option>
                                        <option value="pending" <?= $appointment['status'] == 'pending' ? 'selected' : ''; ?>>En attente</option>
                                        <option value="canceled" <?= $appointment['status'] == 'canceled' ? 'selected' : ''; ?>>Annulé</option>
                                    </select>
                                    <button class="ml-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                        Modifier
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Availability Tab -->
        <div id="availability-tab" class="hidden bg-white shadow rounded-lg">
            <div class="px-4 py-5">
                <h2 class="text-lg font-semibold mb-4">Modifier ma Disponibilité</h2>
                <form method="POST" action="update_availability.php">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="days" class="block font-medium">Jours disponibles :</label>
                            <input type="text" id="days" name="days" class="border p-2 rounded w-full">
                        </div>
                        <div>
                            <label for="hours" class="block font-medium">Heures disponibles :</label>
                            <input type="text" id="hours" name="hours" class="border p-2 rounded w-full">
                        </div>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Enregistrer
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Gestion des onglets
        document.getElementById('tab-appointments').addEventListener('click', () => {
            document.getElementById('appointments-tab').classList.remove('hidden');
            document.getElementById('availability-tab').classList.add('hidden');
        });

        document.getElementById('tab-availability').addEventListener('click', () => {
            document.getElementById('availability-tab').classList.remove('hidden');
            document.getElementById('appointments-tab').classList.add('hidden');
        });
    </script>
</body>
</html>
