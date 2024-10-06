<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Connexion à la base de données

// Vérifier si l'ID du projet est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_projet = intval($_GET['id']);

    // Requête préparée pour récupérer les informations du projet
    $sql = "SELECT * FROM projets WHERE id_projet = :id_projet";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->execute();
    $projet = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le projet existe
    if (!$projet) {
        echo "Projet non trouvé";
        exit;
    }

    // Requête préparée pour récupérer la liste des clients
    $sql_clients = "SELECT id_client, nom FROM clients";
    $stmt_clients = $conn->prepare($sql_clients);
    $stmt_clients->execute();
    $clients = $stmt_clients->fetchAll(PDO::FETCH_ASSOC);
}

// Vérifier si le formulaire a été soumis pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_projet = $_POST['nom_projet'];
    $description = $_POST['description'];
    $id_client = intval($_POST['id_client']);
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $statut = $_POST['statut'];

    // Requête préparée pour mettre à jour les informations du projet
    $sql = "UPDATE projets SET 
                nom_projet = :nom_projet, 
                description = :description, 
                id_client = :id_client, 
                date_debut = :date_debut, 
                date_fin = :date_fin, 
                statut = :statut 
            WHERE id_projet = :id_projet";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom_projet', $nom_projet);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Projet mis à jour avec succès";
        // Redirection vers la liste des projets après la mise à jour
        header("Location: list_projets.php");
        exit;
    } else {
        echo "Erreur de mise à jour : " . $conn->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Projet</title>

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
        <h2>Modifier Projet</h2>
        <form method="POST" action="edit_projet.php?id=<?php echo $id_projet; ?>">
            <div class="mb-3">
                <label for="nom_projet" class="form-label">Nom du Projet</label>
                <input type="text" class="form-control" id="nom_projet" name="nom_projet" value="<?php echo htmlspecialchars($projet['nom_projet']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($projet['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="id_client" class="form-label">Client</label>
                <select class="form-select" id="id_client" name="id_client" required>
                    <?php
                    foreach ($clients as $client) {
                        $selected = ($client['id_client'] == $projet['id_client']) ? 'selected' : '';
                        echo "<option value='{$client['id_client']}' $selected>" . htmlspecialchars($client['nom']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_debut" class="form-label">Date de Début</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?php echo htmlspecialchars($projet['date_debut']); ?>">
            </div>
            <div class="mb-3">
                <label for="date_fin" class="form-label">Date de Fin</label>
                <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?php echo htmlspecialchars($projet['date_fin']); ?>">
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-select" id="statut" name="statut">
                    <option value="en cours" <?php echo ($projet['statut'] == 'en cours') ? 'selected' : ''; ?>>En cours</option>
                    <option value="terminé" <?php echo ($projet['statut'] == 'terminé') ? 'selected' : ''; ?>>Terminé</option>
                    <option value="annulé" <?php echo ($projet['statut'] == 'annulé') ? 'selected' : ''; ?>>Annulé</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
