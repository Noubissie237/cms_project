<?php
include '../db/db_connect.php'; // Connexion à la base de données

// Récupération des consultants et projets pour les afficher dans les listes déroulantes
$sql_consultants = "SELECT id_consultant, nom FROM consultants";
$sql_projets = "SELECT id_projet, nom_projet FROM projets";
$result_consultants = $conn->query($sql_consultants);
$result_projets = $conn->query($sql_projets);

// Traitement du formulaire d'ajout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_consultant = $_POST['id_consultant'];
    $id_projet = $_POST['id_projet'];
    $role = $_POST['role'];

    $sql = "INSERT INTO consultants_projets (id_consultant, id_projet, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iis', $id_consultant, $id_projet, $role);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Consultant ajouté au projet avec succès.</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout : " . $stmt->error . "</div>";
    }
}

$conn->close();
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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">Consultancy System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
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
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Ajouter un Consultant à un Projet</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="id_consultant" class="form-label">Consultant:</label>
                <select name="id_consultant" id="id_consultant" class="form-select" required>
                    <?php while ($row = $result_consultants->fetch_assoc()): ?>
                        <option value="<?= $row['id_consultant'] ?>"><?= $row['nom'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_projet" class="form-label">Projet:</label>
                <select name="id_projet" id="id_projet" class="form-select" required>
                    <?php while ($row = $result_projets->fetch_assoc()): ?>
                        <option value="<?= $row['id_projet'] ?>"><?= $row['nom_projet'] ?></option>
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
