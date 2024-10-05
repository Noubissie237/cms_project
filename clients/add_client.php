<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Insertion dans la base de données
    $sql = "INSERT INTO clients (nom, adresse, email, telephone) VALUES ('$nom', '$adresse', '$email', '$telephone')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Nouveau client ajouté avec succès</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Erreur : " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
   
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Couleur de fond claire */
        body {
            background-color: #f4f6f9;
            font-family: 'Helvetica Neue', sans-serif;
            color: #333;
        }

        /* Conteneur centré avec style */
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 60px auto;
        }

        /* Style pour le titre avec icône */
        h2 {
            text-align: center;
            color: #2980b9;
            font-weight: bold;
            margin-bottom: 30px;
        }

        /* Icône centrée au-dessus du titre */
        .icon-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .icon-container i {
            font-size: 50px;
            color: #2980b9;
        }

        /* Champs de formulaire stylisés */
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
        }

        /* Style pour les labels */
        label {
            font-weight: bold;
            color: #34495e;
        }

        /* Style du bouton */
        .btn-primary {
            background-color: #2980b9;
            border-color: #2980b9;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #1abc9c;
            border-color: #1abc9c;
        }
        
        /* Alertes stylisées */
        .alert {
            margin-top: 20px;
            font-size: 16px;
        }

    </style>
    <!-- Lien vers l'icône FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">Consultancy System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./list_clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../projets/list_projets.php">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../consultants/list_consultants.php">Consultants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../factures/list_factures.php">Factures</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="#2980b9" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            </svg>
        </div>
        <h2>Ajouter un Nouveau Client</h2>
        <form method="POST" action="add_client.php">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Client</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ajouter</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
