<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Facture</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Modifier la Facture</h1>
    <form method="POST">
        <label for="client_id">ID du Client :</label>
        <input type="text" id="client_id" name="client_id" value="<?= htmlspecialchars($invoice[0]['client_id']) ?>" required>

        <label for="amount">Montant :</label>
        <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($invoice[0]['amount']) ?>" required>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date" value="<?= htmlspecialchars($invoice[0]['date']) ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
