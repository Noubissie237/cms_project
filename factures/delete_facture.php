<?php 
include '../auth/auth_check.php'; 
include '../db/db_connect.php'; // Connexion à la base de données

// Vérifier si l'ID de la facture est passé en paramètre
if (isset($_GET['id'])) {
    $id_facture = $_GET['id'];

    // Vérifier si l'ID est un entier valide
    if (filter_var($id_facture, FILTER_VALIDATE_INT)) {
        // Requête pour supprimer la facture avec une requête préparée
        $sql = "DELETE FROM factures WHERE id_facture = :id_facture";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_facture', $id_facture, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Facture supprimée avec succès";
            // Redirection vers la liste des factures après suppression
            header("Location: list_factures.php");
            exit;
        } else {
            echo "Erreur lors de la suppression : " . $stmt->errorInfo()[2];
        }
    } else {
        echo "ID facture invalide.";
    }
} else {
    echo "ID facture non spécifié.";
}
?>
