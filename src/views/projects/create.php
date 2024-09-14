<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Projet</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Ajouter un Projet</h1>
    <form method="POST">
        <label for="title">Titre du Projet :</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>

        <label for="client_id">Client :</label>
        <select id="client_id" name="client_id" required>
            <!-- Générer dynamiquement les options clients -->
            <option selected disabled>Sélectionner un client</option>
            <?php foreach ($clients as $client): ?>
            <option value="<?= $client['id'] ?>"><?= htmlspecialchars($client['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="consultant_id">Consultant :</label>
        <select id="consultant_id" name="consultant_id" required>
            <!-- Générer dynamiquement les options consultants -->
            <option selected disabled>Sélectionner un consultant</option>
            <?php foreach ($consultants as $consultant): ?>
            <option value="<?= $consultant['id'] ?>"><?= htmlspecialchars($consultant['specialization']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="start_date">Date de Début :</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">Date de Fin :</label>
        <input type="date" id="end_date" name="end_date" required>

        <button type="submit">Ajouter le Projet</button>
    </form>
</body>
</html>
