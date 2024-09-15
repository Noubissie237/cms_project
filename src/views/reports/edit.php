<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Rapport</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Modifier le Rapport</h1>
    <form method="POST">
        <label for="project_id">ID du Projet :</label>
        <input type="text" id="project_id" name="project_id" value="<?= htmlspecialchars($report[0]['project_id']) ?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($report[0]['description']) ?></textarea>

        <label for="date">Date :</label>
        <input type="date" id="date" name="date" value="<?= htmlspecialchars($report[0]['date']) ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
