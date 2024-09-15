<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Utilisateur</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Ajouter un Utilisateur</h1>
    
    <!-- Formulaire d'ajout d'utilisateur -->
    <form method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email :</label>
        <input type="text" id="email" name="email" required>
        
        <label for="password">Mot de Passe :</label>
        <input type="password" id="password" name="password" required>
        
        <label for="role">Rôle :</label>
        <select id="role" name="role">
            <option value="admin">Admin</option>
            <option value="consultant">Consultant</option>
        </select>
        
        <button type="submit">Ajouter</button>
    </form>

    <a href="/cms_project/public/users/">Retour à la liste des utilisateurs</a>
</body>
</html>
