<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Patient</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900">Bienvenue, Patient</h1>
            <form method="POST" action="logout.php">
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
                <button id="tab-doctors" class="px-3 py-2 text-gray-500">
                    Tous les Médecins
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
                    <!-- Liste des rendez-vous générée dynamiquement en PHP -->
                    <?php foreach ($appointments as $appointment): ?>
                        <div class="border rounded p-4 flex justify-between items-center">
                            <div>
                                <p class="font-semibold">Avec : <?= $appointment['doctor_name']; ?></p>
                                <p class="text-gray-500">Date : <?= $appointment['date']; ?> | Heure : <?= $appointment['time']; ?></p>
                            </div>
                            <div>
                                <form method="POST" action="cancel_appointment.php">
                                    <input type="hidden" name="appointment_id" value="<?= $appointment['id']; ?>">
                                    <button class="text-red-500 hover:text-red-700">
                                        Annuler
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Doctors Tab -->
        <div id="doctors-tab" class="hidden bg-white shadow rounded-lg">
            <div class="px-4 py-5">
                <h2 class="text-lg font-semibold mb-4">Tous les Médecins</h2>
                <div id="doctors-list">
                    <?php foreach ($doctors as $doctor): ?>
                        <div class="border rounded p-4">
                            <p class="font-semibold"><?= $doctor['name']; ?></p>
                            <p class="text-gray-500">Spécialité : <?= $doctor['speciality']; ?></p>
                            <form method="POST" action="book_appointment.php">
                                <input type="hidden" name="doctor_id" value="<?= $doctor['id']; ?>">
                                <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Réserver un RDV
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Gestion des onglets
        document.getElementById('tab-appointments').addEventListener('click', () => {
            document.getElementById('appointments-tab').classList.remove('hidden');
            document.getElementById('doctors-tab').classList.add('hidden');
        });

        document.getElementById('tab-doctors').addEventListener('click', () => {
            document.getElementById('doctors-tab').classList.remove('hidden');
            document.getElementById('appointments-tab').classList.add('hidden');
        });
    </script>
</body>
</html>
