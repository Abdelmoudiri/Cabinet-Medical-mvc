<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Liste des Patients</h1>
        <a href="/patients/create" class="btn btn-primary">Nouveau Patient</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= htmlspecialchars($patient['nom']) ?></td>
                    <td><?= htmlspecialchars($patient['prenom']) ?></td>
                    <td><?= htmlspecialchars($patient['date_naissance']) ?></td>
                    <td><?= htmlspecialchars($patient['telephone']) ?></td>
                    <td>
                        <a href="/patients/show/<?= $patient['id'] ?>" class="btn btn-info">Voir</a>
                        <a href="/patients/edit/<?= $patient['id'] ?>" class="btn btn-warning">Modifier</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
