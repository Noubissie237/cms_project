<?php 
include '../auth/auth_check.php'; 
include '../db/db_connect.php'; // Connexion à la base de données

// Vérifier si l'ID du projet est passé en paramètre
if (isset($_GET['id'])) {
    $id_projet = $_GET['id'];

    // Vérifier si l'ID est un entier valide
    if (filter_var($id_projet, FILTER_VALIDATE_INT)) {
        // Suppression du projet dans la base de données avec une requête préparée
        $sql = "DELETE FROM projets WHERE id_projet = :id_projet";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_projet', $id_projet, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Projet supprimé avec succès";
            // Redirection vers la liste des projets après suppression
            header("Location: list_projets.php");
            exit;
        } else {
            echo "Erreur lors de la suppression : " . $stmt->errorInfo()[2];
        }
    } else {
        echo "ID projet invalide.";
    }
} else {
    echo "ID projet non spécifié.";
}
?>
