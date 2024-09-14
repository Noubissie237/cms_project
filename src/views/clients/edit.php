<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Client</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Modifier le Client</h1>
    <form method="POST">
        <label for="name">Nom du Client :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($client[0]['name']) ?>" required>

        <label for="contact">Contact :</label>
        <input type="text" id="contact" name="contact" value="<?= htmlspecialchars($client[0]['contact']) ?>" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($client[0]['email']) ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
