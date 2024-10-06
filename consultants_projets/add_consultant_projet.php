<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Connexion à la base de données

// Récupération des consultants et projets pour les afficher dans les listes déroulantes
$sql_consultants = "SELECT id_consultant, nom FROM consultants";
$sql_projets = "SELECT id_projet, nom_projet FROM projets";
$result_consultants = $conn->query($sql_consultants);
$result_projets = $conn->query($sql_projets);

// Traitement du formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validation des entrées
    $id_consultant = filter_var($_POST['id_consultant'], FILTER_VALIDATE_INT);
    $id_projet = filter_var($_POST['id_projet'], FILTER_VALIDATE_INT);
    $role = trim($_POST['role']);
    
    if ($id_consultant && $id_projet && !empty($role)) {
        // Requête préparée pour éviter les injections SQL
        $sql = "INSERT INTO consultants_projets (id_consultant, id_projet, role) VALUES (:id_consultant, :id_projet, :role)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_consultant', $id_consultant, PDO::PARAM_INT);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Mission ajouté au projet avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de l'ajout : " . $stmt->errorInfo()[2] . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs correctement.</div>";
    }
}

$conn = null; // Fermeture de la connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Consultant à un Projet</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #343a40;
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
                        <a class="nav-link" href="../factures/list_factures.php">Factures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./list_consultant_projet.php">Missions</a>
                    </li>
                </ul>
                <a href="../connexion/logout.php" class="btn btn-danger mb-3 ms-auto">Déconnexion</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Ajouter un Consultant à un Projet</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="id_consultant" class="form-label">Consultant:</label>
                <select name="id_consultant" id="id_consultant" class="form-select" required>
                    <?php while ($row = $result_consultants->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $row['id_consultant'] ?>"><?= htmlspecialchars($row['nom']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_projet" class="form-label">Projet:</label>
                <select name="id_projet" id="id_projet" class="form-select" required>
                    <?php while ($row = $result_projets->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $row['id_projet'] ?>"><?= htmlspecialchars($row['nom_projet']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rôle:</label>
                <input type="text" name="role" id="role" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
