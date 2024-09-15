<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Factures</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Liste des Factures</h1>
    <form action="/cms_project/public/invoices/create/">
        <button type="submit">Ajouter</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID du Client</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= htmlspecialchars($invoice[0]['client_id']) ?></td>
                <td><?= htmlspecialchars($invoice[0]['amount']) ?></td>
                <td><?= htmlspecialchars($invoice[0]['date']) ?></td>
                <td>
                    <form action="/cms_project/public/invoices/delete/<?= $invoice['id'] ?>/" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?');">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                <td>
                    <form action="/cms_project/public/invoices/edit/<?= $invoice['id'] ?>/" method="GET">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
