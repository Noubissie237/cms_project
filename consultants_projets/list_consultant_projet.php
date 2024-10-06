<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

try {
    // Requête pour récupérer tous les projets
    $sql = "
    SELECT cp.id_consultant, cp.id_projet, cp.role, cons.nom AS nom_consultant, p.nom_projet 
    FROM consultants_projets cp
    JOIN consultants cons ON cp.id_consultant = cons.id_consultant
    JOIN projets p ON cp.id_projet = p.id_projet";
    $stmt = $conn->query($sql); // Utilisation de query avec PDO
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats sous forme de tableau associatif
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des projets : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Mission</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Image de fond couvrant toute la page */
        body {
            background: url('../images/mission.jpg') no-repeat center center fixed;
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
        <h2>Liste des Missions</h2>
        <a href="add_consultant_projet.php" class="btn btn-success mb-3">
            Ajouter une mission
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
            <?php
                if (!empty($projets)) {
                    // Affichage de chaque ligne
                    foreach ($projets as $projet) {
                        echo "<tr>
                                <td>" . $projet['nom_consultant'] . "</td>
                                <td>" . $projet['nom_projet'] . "</td>
                                <td>" . $projet['role'] . "</td>
                                <td>
                                    <a href='edit_consultant_projet.php?id_consultant=" . $projet['id_consultant'] . "&id_projet=".$projet['id_projet']."' class='btn btn-warning btn-sm'>Modifier</a>
                                    <a href='delete_consultant_projet.php?id_consultant=" . $projet['id_consultant'] . "&id_projet=".$projet['id_projet']."' class='btn btn-danger btn-sm'>Supprimer</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Aucune mission trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
