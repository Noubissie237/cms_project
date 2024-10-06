<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du consultant est passé en paramètre
if (isset($_GET['id'])) {
    $id_consultant = $_GET['id'];

    // Récupérer les informations du consultant
    $sql = "SELECT * FROM consultants WHERE id_consultant = :id_consultant";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_consultant', $id_consultant, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $consultant = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<div class='alert alert-danger text-center'>Consultant non trouvé</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de consultant invalide</div>";
    exit;
}

// Vérifier si le formulaire a été soumis pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Mise à jour des informations du consultant dans la base de données
    $sql = "UPDATE consultants SET nom='$nom', specialite='$specialite', email='$email', telephone='$telephone' WHERE id_consultant = $id_consultant";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        echo "Consultant mis à jour avec succès";
        // Redirection vers la liste des consultants après la mise à jour
        header("Location: list_consultants.php");
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Erreur de mise à jour : " . $conn->errorInfo()[2] . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Consultant</title>
    <!-- Lien vers Bootstrap CSS -->
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
    <div class="container mt-5">
        <h2>Modifier Consultant</h2>
        <form method="POST" action="edit_consultant.php?id=<?php echo $id_consultant; ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Consultant</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $consultant['nom']; ?>" required>
            </div>
            <div class="mb-3">
            <label for="specialite" class="form-label">Spécialité</label>
                <input type="text" class="form-control" id="specialite" name="specialite" value="<?php echo $consultant['specialite']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $consultant['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $consultant['telephone']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Mettre à Jour le Consultant</button>
        </form>
    </div>

    <!-- Lien vers Bootstrap JS et Popper.js -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
