<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un Projet</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Modifier le Projet</h1>
    <form method="POST">
        <label for="title">Titre du Projet :</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($project[0]['title']) ?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($project[0]['description']) ?></textarea>

        <label for="status">Status :</label>
        <select id="status" name="status" required>
            <option value="<?= $project[0]['status']?>" <?= ($project[0]['status'] == $project[0]['status']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($project[0]['status']) ?>
        </select>

        <label for="start_date">Date de Début :</label>
        <input type="date" id="start_date" name="start_date" value="<?= $project[0]['start_date'] ?>" required>

        <label for="end_date">Date de Fin :</label>
        <input type="date" id="end_date" name="end_date" value="<?= $project[0]['end_date'] ?>" required>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
