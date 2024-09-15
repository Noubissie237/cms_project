<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Projects</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Liste des Projects</h1>
    <form action="/cms_project/public/projects/create/">
        <button type="submit">Ajouter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Client</th>
                <th>Consultant</th>
                <th>start_date</th>
                <th>end_date</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= htmlspecialchars($project[0]['title']) ?></td>
                <td><?= htmlspecialchars($project[0]['client_id']) ?></td>
                <td><?= htmlspecialchars($project[0]['consultant_id']) ?></td>
                <td><?= htmlspecialchars($project[0]['start_date']) ?></td>
                <td><?= htmlspecialchars($project[0]['end_date']) ?></td>
                <td><?= htmlspecialchars($project[0]['status']) ?></td>
                <td>
                    <form action="/cms_project/public/projects/delete/<?= $project['id'] ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                <td>
                    <form action="/cms_project/public/projects/edit/<?= $project['id'] ?>/" method="GET">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>