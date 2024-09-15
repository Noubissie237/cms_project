<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Rapport</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Ajouter un Rapport</h1>
    
    <form method="POST">
        <label for="project_id">ID du Projet :</label>
        <input type="text" id="project_id" name="project_id" required>
        
        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required>
        
        <button type="submit">Ajouter</button>
    </form>

    <a href="/cms_project/public/reports/">Retour à la liste des rapports</a>
</body>
</html>
