<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Récupérer les projets pour les lier à une facture
try {
    $projets_stmt = $conn->query("SELECT id_projet, nom_projet FROM projets");
    $projets = $projets_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des projets : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_projet = $_POST['id_projet'];
    $montant = trim($_POST['montant']);
    $date_emission = $_POST['date_emission'];
    $statut = $_POST['statut'];

    // Validation du montant pour s'assurer qu'il s'agit bien d'un nombre
    if (!is_numeric($montant)) {
        echo "<div class='alert alert-danger text-center'>Le montant doit être un nombre valide</div>";
    } else {
        try {
            // Utilisation des requêtes préparées pour éviter les injections SQL
            $sql = "INSERT INTO factures (id_projet, montant, date_emission, statut) 
                    VALUES (:id_projet, :montant, :date_emission, :statut)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
            $stmt->bindParam(':montant', $montant);
            $stmt->bindParam(':date_emission', $date_emission);
            $stmt->bindParam(':statut', $statut);

            // Exécution de la requête
            if ($stmt->execute()) {
                echo "<div class='alert alert-success text-center'>Nouvelle facture ajoutée avec succès</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Erreur lors de l'ajout de la facture</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger text-center'>Erreur lors de l'ajout de la facture : " . $e->getMessage() . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Facture</title>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../clients/list_clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../projets/list_projets.php">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../consultants/list_consultants.php">Consultants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./list_factures.php">Factures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../consultants_projets/list_consultant_projet.php">Missions</a>
                    </li>
                </ul>
                <a href="../connexion/logout.php" class="btn btn-danger mb-3 ms-auto">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="#12dd11" class="bi bi-cash-coin" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
            </svg>
        </div>
        <h2>Ajouter une Nouvelle Facture</h2>
        <form method="POST" action="add_facture.php">
            <div class="mb-3">
                <label for="id_projet" class="form-label">Projet</label>
                <select class="form-control" id="id_projet" name="id_projet" required>
                    <?php foreach ($projets as $projet): ?>
                        <option value="<?= $projet['id_projet'] ?>"><?= $projet['nom_projet'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="montant" class="form-label">Montant</label>
                <input type="text" class="form-control" id="montant" name="montant" placeholder="Montant en FCFA    " required>
            </div>
            <div class="mb-3">
                <label for="date_emission" class="form-label">Date d'Émission</label>
                <input type="date" class="form-control" id="date_emission" name="date_emission" required>
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-control" id="statut" name="statut" required>
                    <option value="payée">Payée</option>
                    <option value="non payée">Non Payée</option>
                    </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Ajouter la Facture</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
