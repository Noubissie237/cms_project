<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Consultant</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Ajouter un Consultant</h1>
    
    <form method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
        
        <label for="specialization">Spécialisation :</label>
        <input type="text" id="specialization" name="specialization" required>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Ajouter</button>
    </form>

    <a href="/cms_project/public/consultants/">Retour à la liste des consultants</a>
</body>
</html>
