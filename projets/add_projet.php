<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Récupérer les clients pour le menu déroulant
$clients = $conn->query("SELECT id_client, nom FROM clients");

if (!$clients) {
    // Affiche une erreur si la requête échoue
    die("Erreur lors de la récupération des clients : " . $conn->error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données reçues
    $nom_projet = trim($_POST['nom_projet']);
    $description = trim($_POST['description']);
    $id_client = $_POST['id_client'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $statut = $_POST['statut'];

    // Utilisation des requêtes préparées pour l'insertion
    $sql = "INSERT INTO projets (nom_projet, description, id_client, date_debut, date_fin, statut) 
            VALUES (:nom_projet, :description, :id_client, :date_debut, :date_fin, :statut)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom_projet', $nom_projet);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->bindParam(':statut', $statut);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Nouveau projet ajouté avec succès</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout du projet : " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Projet</title>

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Vos styles ici */
    </style>
</head>
<body>

    <style>
        /* Couleur de fond claire */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background: linear-gradient(to bottom, white, #f4f6f9, grey);
            font-family: 'Helvetica Neue', sans-serif;
            color: #333;
            background-size: cover;
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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">Consultancy System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../clients/list_clients.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./list_projets.php">Projets</a></li>
                    <li class="nav-item"><a class="nav-link" href="../consultants/list_consultants.php">Consultants</a></li>
                    <li class="nav-item"><a class="nav-link" href="../factures/list_factures.php">Factures</a></li>
                    <li class="nav-item"><a class="nav-link" href="../consultants_projets/list_consultant_projet.php">Missions</a></li>
                </ul>
                <a href="../connexion/logout.php" class="btn btn-danger mb-3 ms-auto">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Ajouter un Nouveau Projet</h2>

        <!-- Formulaire d'ajout de projet -->
        <form method="POST" action="add_projet.php">
            <div class="mb-3">
                <label for="nom_projet" class="form-label">Nom du Projet</label>
                <input type="text" class="form-control" id="nom_projet" name="nom_projet" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="id_client" class="form-label">Client</label>
                <select class="form-select" id="id_client" name="id_client" required>
                    <option value="">Sélectionner un client</option>
                    <?php
                    while ($row = $clients->fetch()) {
                        echo "<option value='{$row['id_client']}'>{$row['nom']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de Début</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut">
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de Fin</label>
                <input type="date" class="form-control" id="date_fin" name="date_fin">
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-select" id="statut" name="statut">
                    <option value="en cours">En cours</option>
                    <option value="terminé">Terminé</option>
                    <option value="annulé">Annulé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
