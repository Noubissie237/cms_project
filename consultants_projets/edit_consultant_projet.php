<?php
include '../db/db_connect.php'; // Connexion à la base de données

if (isset($_GET['id_consultant']) && isset($_GET['id_projet'])) {
    $id_consultant = $_GET['id_consultant'];
    $id_projet = $_GET['id_projet'];

    // Récupérer les informations actuelles de la relation consultant-projet
    $sql = "SELECT * FROM consultants_projets WHERE id_consultant = $id_consultant AND id_projet = $id_projet";
    $result = $conn->query($sql);
    $consultant_projet = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_id_consultant = $_POST['id_consultant'];
        $new_id_projet = $_POST['id_projet'];
        $role = $_POST['role'];

        // Vérifier si la relation consultant-projet existe déjà
        $check_sql = "SELECT * FROM consultants_projets WHERE id_consultant = $new_id_consultant AND id_projet = $new_id_projet";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0 && ($new_id_consultant != $id_consultant || $new_id_projet != $id_projet)) {
            echo "<script>alert('Cette relation consultant-projet existe déjà.');</script>";
        } else {
            $update_sql = "UPDATE consultants_projets SET id_consultant = $new_id_consultant, id_projet = $new_id_projet, role = '$role' WHERE id_consultant = $id_consultant AND id_projet = $id_projet";
            if ($conn->query($update_sql) === TRUE) {
                echo "<script>alert('Consultant-Projet mis à jour avec succès.'); window.location.href = 'list_consultant_projet.php';</script>";
            } else {
                echo "Erreur lors de la mise à jour : " . $conn->error;
            }
        }
    }
} else {
    echo "ID consultant ou projet manquant.";
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
    <div class="container">
        <h2>Modifier un Consultant-Projet</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="id_consultant" class="form-label">Consultant:</label>
                <select name="id_consultant" id="id_consultant" class="form-select" required>
                    <?php
                    $sql_consultants = "SELECT id_consultant, nom FROM consultants";
                    $result_consultants = $conn->query($sql_consultants);
                    while ($row = $result_consultants->fetch_assoc()) {
                        echo "<option value='" . $row['id_consultant'] . "'" . ($row['id_consultant'] == $consultant_projet['id_consultant'] ? ' selected' : '') . ">" . $row['nom'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_projet" class="form-label">Projet:</label>
                <select name="id_projet" id="id_projet" class="form-select" required>
                    <?php
                    $sql_projets = "SELECT id_projet, nom_projet FROM projets";
                    $result_projets = $conn->query($sql_projets);
                    while ($row = $result_projets->fetch_assoc()) {
                        echo "<option value='" . $row['id_projet'] . "'" . ($row['id_projet'] == $consultant_projet['id_projet'] ? ' selected' : '') . ">" . $row['nom_projet'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rôle:</label>
                <input type="text" name="role" class="form-control" value="<?php echo $consultant_projet['role']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
