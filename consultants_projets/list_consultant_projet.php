<?php
include '../db/db_connect.php'; // Connexion à la base de données

$sql = "
    SELECT cp.id_consultant, cp.id_projet, cp.role, cons.nom AS nom_consultant, p.nom_projet 
    FROM consultants_projets cp
    JOIN consultants cons ON cp.id_consultant = cons.id_consultant
    JOIN projets p ON cp.id_projet = p.id_projet";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Consultants et Projets</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style de la page */
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* Centrage du contenu */
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        /* Style de la table */
        table {
            width: 100%;
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        td {
            background-color: #f8f9fa;
        }

        /* Style des liens d'action */
        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Style du titre */
        h2 {
            color: #343a40;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }

        /* Style pour les boutons */
        .btn-action {
            display: inline-block;
            margin: 0 5px;
            padding: 5px 10px;
            font-size: 14px;
            color: #fff;
            background-color: #28a745;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-action.delete {
            background-color: #dc3545;
        }
        
        .btn-action:hover {
            opacity: 0.85;
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
        <h2>Liste des Consultants et Projets</h2>
        <a href="add_consultant_projet.php" class="btn btn-success mb-3">
            Ajouter un Consultant à un projet
        </a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Consultant</th>
                    <th>Projet</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nom_consultant'] ?></td>
                        <td><?= $row['nom_projet'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td>
                            <a href="edit_consultant_projet.php?id_consultant=<?= $row['id_consultant'] ?>&id_projet=<?= $row['id_projet'] ?>" class="btn-action">Modifier</a>
                            <a href="delete_consultant_projet.php?id_consultant=<?= $row['id_consultant'] ?>&id_projet=<?= $row['id_projet'] ?>" class="btn-action delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
