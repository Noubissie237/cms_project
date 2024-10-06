<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Connexion à la base de données

if (isset($_GET['id_consultant']) && isset($_GET['id_projet']) && is_numeric($_GET['id_consultant']) && is_numeric($_GET['id_projet'])) {
    $id_consultant = intval($_GET['id_consultant']);
    $id_projet = intval($_GET['id_projet']);

    // Requête préparée pour récupérer les informations actuelles de la relation consultant-projet
    $sql = "SELECT * FROM consultants_projets WHERE id_consultant = :id_consultant AND id_projet = :id_projet";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_consultant', $id_consultant, PDO::PARAM_INT);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
    $consultant_projet = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_id_consultant = intval($_POST['id_consultant']);
        $new_id_projet = intval($_POST['id_projet']);
        $role = $_POST['role'];

        // Vérifier si la relation consultant-projet existe déjà
        $check_sql = "SELECT * FROM consultants_projets WHERE id_consultant = :new_id_consultant AND id_projet = :new_id_projet";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bindParam(':new_id_consultant', $new_id_consultant, PDO::PARAM_INT);
        $check_stmt->bindParam(':new_id_projet', $new_id_projet, PDO::PARAM_INT);
        $check_stmt->execute();

        if ($check_stmt->rowCount() > 0 && ($new_id_consultant != $id_consultant || $new_id_projet != $id_projet)) {
            echo "<script>alert('Cette relation consultant-projet existe déjà.');</script>";
        } else {
            // Requête préparée pour mettre à jour la relation consultant-projet
            $update_sql = "UPDATE consultants_projets SET id_consultant = :new_id_consultant, id_projet = :new_id_projet, role = :role WHERE id_consultant = :id_consultant AND id_projet = :id_projet";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bindParam(':new_id_consultant', $new_id_consultant, PDO::PARAM_INT);
            $update_stmt->bindParam(':new_id_projet', $new_id_projet, PDO::PARAM_INT);
            $update_stmt->bindParam(':role', $role);
            $update_stmt->bindParam(':id_consultant', $id_consultant, PDO::PARAM_INT);
            $update_stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);

            if ($update_stmt->execute()) {
                echo "<script> window.location.href = 'list_consultant_projet.php';</script>";
            } else {
                echo "Erreur lors de la mise à jour : " . $conn->errorInfo()[2];
            }
        }
    }
} else {
    echo "ID consultant ou projet manquant ou invalide.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Consultant-Projet</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Couleur de fond claire */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background: linear-gradient(to bottom, white, #87CEEB, #4682B4);
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
    <div class="container">
        <h2>Modifier un Consultant-Projet</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="id_consultant" class="form-label">Consultant:</label>
                <select name="id_consultant" id="id_consultant" class="form-select" required>
                    <?php
                    // Requête préparée pour récupérer les consultants
                    $sql_consultants = "SELECT id_consultant, nom FROM consultants";
                    $stmt_consultants = $conn->prepare($sql_consultants);
                    $stmt_consultants->execute();
                    $consultants = $stmt_consultants->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($consultants as $row) {
                        echo "<option value='" . $row['id_consultant'] . "'" . ($row['id_consultant'] == $consultant_projet['id_consultant'] ? ' selected' : '') . ">" . htmlspecialchars($row['nom']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_projet" class="form-label">Projet:</label>
                <select name="id_projet" id="id_projet" class="form-select" required>
                    <?php
                    // Requête préparée pour récupérer les projets
                    $sql_projets = "SELECT id_projet, nom_projet FROM projets";
                    $stmt_projets = $conn->prepare($sql_projets);
                    $stmt_projets->execute();
                    $projets = $stmt_projets->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($projets as $row) {
                        echo "<option value='" . $row['id_projet'] . "'" . ($row['id_projet'] == $consultant_projet['id_projet'] ? ' selected' : '') . ">" . htmlspecialchars($row['nom_projet']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rôle:</label>
                <input type="text" name="role" class="form-control" value="<?php echo htmlspecialchars($consultant_projet['role']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
