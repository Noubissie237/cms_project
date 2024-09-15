<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rapports</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Liste des Rapports</h1>
    <form action="/cms_project/public/reports/create/">
        <button type="submit">Ajouter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID du Projet</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reports as $report): ?>
            <tr>
                <td><?= htmlspecialchars($report[0]['project_id']) ?></td>
                <td><?= htmlspecialchars($report[0]['description']) ?></td>
                <td><?= htmlspecialchars($report[0]['date']) ?></td>
                <td>
                    <form action="/cms_project/public/reports/delete/<?= $report['id'] ?>/" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                <td>
                    <form action="/cms_project/public/reports/edit/<?= $report['id'] ?>/" method="GET">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
