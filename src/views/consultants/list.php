<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Consultants</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Liste des Consultants</h1>
    <form action="/cms_project/public/consultants/create/">
        <button type="submit">Ajouter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Spécialisation</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultants as $consultant): ?>
            <tr>
                <td><?= htmlspecialchars($consultant[0]['name']) ?></td>
                <td><?= htmlspecialchars($consultant[0]['specialization']) ?></td>
                <td><?= htmlspecialchars($consultant[0]['email']) ?></td>
                <td>
                    <form action="/cms_project/public/consultants/delete/<?= $consultant['id'] ?>/" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce consultant ?');">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                <td>
                    <form action="/cms_project/public/consultants/edit/<?= $consultant['id'] ?>/" method="GET">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
