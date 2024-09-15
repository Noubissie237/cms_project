<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Consultant</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Modifier le Consultant</h1>
    <form method="POST">
        <label for="name">Nom du Consultant :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($consultant[0]['name']) ?>" required>

        <label for="specialization">Spécialisation :</label>
        <input type="text" id="specialization" name="specialization" value="<?= htmlspecialchars($consultant[0]['specialization']) ?>" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($consultant[0]['email']) ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
