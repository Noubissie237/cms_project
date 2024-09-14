<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Client</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Ajouter un Client</h1>
    
    <!-- Formulaire d'ajout de client -->
    <form method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
        
        <label for="contact">Contact :</label>
        <input type="text" id="contact" name="contact" required>
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Ajouter</button>
    </form>

    <a href="/cms_project/public/clients/">Retour à la liste des clients</a>
</body>
</html>
