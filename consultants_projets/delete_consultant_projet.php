<?php 
include '../auth/auth_check.php'; 
include '../db/db_connect.php'; // Connexion à la base de données

if (isset($_GET['id_consultant']) && isset($_GET['id_projet'])) {
    $id_consultant = $_GET['id_consultant'];
    $id_projet = $_GET['id_projet'];

    // Vérifier si les IDs sont des entiers valides
    if (filter_var($id_consultant, FILTER_VALIDATE_INT) && filter_var($id_projet, FILTER_VALIDATE_INT)) {
        // Suppression de la relation consultant-projet avec une requête préparée
        $sql = "DELETE FROM consultants_projets WHERE id_consultant = :id_consultant AND id_projet = :id_projet";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_consultant', $id_consultant, PDO::PARAM_INT);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>window.location.href = 'list_consultant_projet.php';</script>";
            exit;
        } else {
            echo "Erreur lors de la suppression : " . $stmt->errorInfo()[2];
        }
    } else {
        echo "ID consultant ou projet invalide.";
    }
} else {
    echo "ID consultant ou projet manquant.";
}
?>
