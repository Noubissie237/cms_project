<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du client est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Suppression du client dans la base de données
    $sql = "DELETE FROM clients WHERE id_client = $id_client";

    if ($conn->query($sql) === TRUE) {
        echo "Client supprimé avec succès";
        // Redirection vers la liste des clients après suppression
        header("Location: list_clients.php");
        exit;
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
} else {
    echo "ID client non spécifié";
}
?>
