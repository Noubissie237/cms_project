<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Utilisateur</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Modifier l'Utilisateur</h1>
    <form method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user[0]['name']) ?>" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user[0]['email']) ?>" required>

        <label for="role">Rôle :</label>
        <select id="role" name="role">
            <option value="admin" <?= $user[0]['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="consultant" <?= $user[0]['role'] === 'consultant' ? 'selected' : '' ?>>Consultant</option>
        </select>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
