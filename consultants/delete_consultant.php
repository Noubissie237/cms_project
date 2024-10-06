<?php 
include '../auth/auth_check.php'; 
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du consultant est passé en paramètre
if (isset($_GET['id'])) {
    $id_consultant = $_GET['id'];

    // Vérifier si l'ID est un entier valide
    if (filter_var($id_consultant, FILTER_VALIDATE_INT)) {
        // Suppression du consultant avec une requête préparée
        $sql = "DELETE FROM consultants WHERE id_consultant = :id_consultant";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_consultant', $id_consultant, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Consultant supprimé avec succès";
            // Redirection vers la liste des consultants après suppression
            header("Location: list_consultants.php");
            exit;
        } else {
            echo "Erreur lors de la suppression : " . $stmt->errorInfo()[2];
        }
    } else {
        echo "ID consultant invalide";
    }
} else {
    echo "ID consultant non spécifié";
}
?>
