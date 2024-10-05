<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID de la facture est passé en paramètre
if (isset($_GET['id'])) {
    $id_facture = $_GET['id'];

    // Requête pour supprimer la facture
    $sql = "DELETE FROM factures WHERE id_facture = $id_facture";

    if ($conn->query($sql) === TRUE) {
        echo "Facture supprimée avec succès";
        header("Location: list_factures.php");
        exit;
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
}
?>
