<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Facture</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Ajouter une Facture</h1>
    
    <form method="POST">
        <label for="client_id">ID du Client :</label>
        <input type="text" id="client_id" name="client_id" required>
        
        <label for="amount">Montant :</label>
        <input type="text" id="amount" name="amount" required>
        
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" required>
        
        <button type="submit">Ajouter</button>
    </form>

    <a href="/cms_project/public/invoices/">Retour à la liste des factures</a>
</body>
</html>
