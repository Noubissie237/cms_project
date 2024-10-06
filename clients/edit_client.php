<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du client est passé en paramètre et est un entier valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_client = intval($_GET['id']);

    // Requête préparée pour récupérer les informations du client
    $sql = "SELECT * FROM clients WHERE id_client = :id_client";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<div class='alert alert-danger text-center'>Client non trouvé</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de client invalide</div>";
    exit;
}

// Vérifier si le formulaire a été soumis pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Requête préparée pour mettre à jour les informations du client
    $sql = "UPDATE clients SET nom = :nom, adresse = :adresse, email = :email, telephone = :telephone WHERE id_client = :id_client";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);

    // Exécuter la mise à jour et gérer les erreurs
    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Client mis à jour avec succès</div>";
        // Redirection vers la liste des clients après la mise à jour
        header("Location: list_clients.php");
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
    <title>Modifier Client</title>
    
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
        <h2>Modifier Client</h2>
        <form method="POST" action="edit_client.php?id=<?php echo $id_client; ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Client</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo htmlspecialchars($client['adresse']); ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
