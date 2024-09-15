<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Liste des Clients</h1>
    <form action="/cms_project/public/clients/create/">
        <button type="submit">Ajouter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Contact</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= htmlspecialchars($client[0]['name']) ?></td>
                <td><?= htmlspecialchars($client[0]['contact']) ?></td>
                <td><?= htmlspecialchars($client[0]['email']) ?></td>
                <td>
                    <form action="/cms_project/public/clients/delete/<?= $client['id'] ?>/" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                <td>
                    <form action="/cms_project/public/clients/edit/<?= $client['id'] ?>/" method="GET">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>