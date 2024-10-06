<?php 
include '../auth/auth_check.php'; 
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du client est passé en paramètre
if (isset($_GET['id'])) {
    $id_client = $_GET['id'];

    // Vérifier si l'ID est un entier valide
    if (filter_var($id_client, FILTER_VALIDATE_INT)) {
        // Suppression du client avec une requête préparée
        $sql = "DELETE FROM clients WHERE id_client = :id_client";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Client supprimé avec succès";
            // Redirection vers la liste des clients après suppression
            header("Location: list_clients.php");
            exit;
        } else {
            echo "Erreur lors de la suppression : " . $conn->errorInfo()[2];
        }
    } else {
        echo "ID client invalide";
    }
} else {
    echo "ID client non spécifié";
}
?>
