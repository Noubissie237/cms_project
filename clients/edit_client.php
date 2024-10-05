<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du client est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Récupérer les informations du client
    $sql = "SELECT * FROM clients WHERE id_client = $id_client";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger text-center'>Client non trouvé</div>";
        exit;
    }
}

// Vérifier si le formulaire a été soumis pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    // Mettre à jour les informations du client dans la base de données
    $sql = "UPDATE clients SET nom='$nom', adresse='$adresse', email='$email', telephone='$telephone' WHERE id_client = $id_client";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success text-center'>Client mis à jour avec succès</div>";
        // Redirection vers la liste des clients après la mise à jour
        header("Location: list_clients.php");
        exit;
    } else {
        echo "<div class='alert alert-danger text-center'>Erreur de mise à jour : " . $conn->error . "</div>";
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

    <div class="container mt-5">

        <h2>Modifier Client</h2>
        <form method="POST" action="edit_client.php?id=<?php echo $id_client; ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Client</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $client['nom']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $client['adresse']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $client['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo $client['telephone']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
