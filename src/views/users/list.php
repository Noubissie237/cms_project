<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Liste des Utilisateurs</h1>
    <form action="/cms_project/public/users/create/">
        <button type="submit">Ajouter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user[0]['name']) ?></td>
                <td><?= htmlspecialchars($user[0]['email']) ?></td>
                <td><?= htmlspecialchars($user[0]['role']) ?></td>
                <td>
                    <form action="/cms_project/public/users/delete/<?= $user['id'] ?>/" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                <td>
                    <form action="/cms_project/public/users/edit/<?= $user['id'] ?>/" method="GET">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
