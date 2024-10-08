<?php include '../auth/auth_check.php'; ?>
<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID de la facture est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_facture = intval($_GET['id']);

    // Requête préparée pour récupérer les informations de la facture
    $sql = "SELECT * FROM factures WHERE id_facture = :id_facture";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_facture', $id_facture, PDO::PARAM_INT);
    $stmt->execute();
    $facture = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$facture) {
        echo "Facture non trouvée";
        exit;
    }

    // Requête préparée pour récupérer les projets pour les lier à une facture
    $sql_projets = "SELECT id_projet, nom_projet FROM projets";
    $stmt_projets = $conn->prepare($sql_projets);
    $stmt_projets->execute();
    $projets = $stmt_projets->fetchAll(PDO::FETCH_ASSOC);
}

// Vérifier si le formulaire a été soumis pour la mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_projet = intval($_POST['id_projet']);
    $montant = $_POST['montant'];
    $date_emission = $_POST['date_emission'];
    $statut = $_POST['statut'];

    // Requête préparée pour mettre à jour les informations de la facture
    $sql = "UPDATE factures SET id_projet = :id_projet, montant = :montant, date_emission = :date_emission, statut = :statut 
            WHERE id_facture = :id_facture";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);
    $stmt->bindParam(':montant', $montant);
    $stmt->bindParam(':date_emission', $date_emission);
    $stmt->bindParam(':statut', $statut);
    $stmt->bindParam(':id_facture', $id_facture, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Facture mise à jour avec succès";
        header("Location: list_factures.php");
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
    <title>Modifier Facture</title>
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
        <h2>Modifier Facture</h2>
        <form method="POST" action="edit_facture.php?id=<?php echo $id_facture; ?>">
            <div class="mb-3">
                <label for="id_projet" class="form-label">Projet</label>
                <select class="form-control" id="id_projet" name="id_projet" required>
                    <?php
                    foreach ($projets as $projet) {
                        $selected = ($projet['id_projet'] == $facture['id_projet']) ? 'selected' : '';
                        echo "<option value='" . $projet['id_projet'] . "' $selected>" . htmlspecialchars($projet['nom_projet']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="montant" class="form-label">Montant</label>
                <input type="text" class="form-control" id="montant" name="montant" value="<?php echo htmlspecialchars($facture['montant']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_emission" class="form-label">Date d'émission</label>
                <input type="date" class="form-control" id="date_emission" name="date_emission" value="<?php echo htmlspecialchars($facture['date_emission']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-control" id="statut" name="statut" required>
                    <option value="payée" <?php echo ($facture['statut'] == 'payée') ? 'selected' : ''; ?>>Payée</option>
                    <option value="non payée" <?php echo ($facture['statut'] == 'non payée') ? 'selected' : ''; ?>>Non payée</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
