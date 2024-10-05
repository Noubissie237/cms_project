<?php
include '../db/db_connect.php'; // Connexion à la base de données

// Requête pour récupérer tous les projets
$sql = "SELECT projets.*, clients.nom AS nom_client FROM projets JOIN clients ON projets.id_client = clients.id_client";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Projets</title>

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Image de fond couvrant toute la page */
        body {
            background: url('../images/projet.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        /* Ombre et transparence sur le conteneur principal */
        .container {
            background-color: rgba(255, 255, 255, 0.3);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Styles pour le titre */
        h2 {
            text-align: center;
            color: #2c3e50;
            font-weight: bold;
            margin-bottom: 30px;
        }

        /* Styles personnalisés pour le tableau */
        table.table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        table thead th {
            background-color: #2980b9;
            color: white;
            text-align: center;
        }

        table tbody tr {
            text-align: center;
            transition: background-color 0.3s;
        }

        table tbody tr:hover {
            background-color: #f0f8ff;
        }

        /* Boutons stylisés */
        .btn {
            border-radius: 20px;
            font-size: 14px;
        }

        .btn-success {
            background-color: #27ae60;
            border-color: #27ae60;
        }

        .btn-warning {
            background-color: #f39c12;
            border-color: #e67e22;
        }

        .btn-danger {
            background-color: #e74c3c;
            border-color: #c0392b;
        }

        /* Pied de page */
        footer {
            margin-top: 30px;
            text-align: center;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../">Consultancy System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../clients/list_clients.php">Clients</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./list_projets.php">Projets</a></li>
                    <li class="nav-item"><a class="nav-link" href="../consultants/list_consultants.php">Consultants</a></li>
                    <li class="nav-item"><a class="nav-link" href="../factures/list_factures.php">Factures</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Liste des Projets</h2>
        <a href="add_projet.php" class="btn btn-success mb-3">Ajouter un Projet</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Projet</th>
                    <th>Client</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_projet']}</td>
                                <td>{$row['nom_projet']}</td>
                                <td>{$row['nom_client']}</td>
                                <td>{$row['date_debut']}</td>
                                <td>{$row['date_fin']}</td>
                                <td>{$row['statut']}</td>
                                <td>
                                    <a href='edit_projet.php?id={$row['id_projet']}' class='btn btn-warning btn-sm'>Modifier</a>
                                    <a href='delete_projet.php?id={$row['id_projet']}' class='btn btn-danger btn-sm'>Supprimer</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Aucun projet trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
