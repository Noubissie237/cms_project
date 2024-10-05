<?php
include '../db/db_connect.php'; // Connexion à la base de données

// Vérifier si l'ID du projet est passé en paramètre
if (isset($_GET['id'])) {
    $id_projet = $_GET['id'];

    // Suppression du projet dans la base de données
    $sql = "DELETE FROM projets WHERE id_projet = $id_projet";

    if ($conn->query($sql) === TRUE) {
        echo "Projet supprimé avec succès";
        // Redirection vers la liste des projets après suppression
        header("Location: list_projets.php");
        exit;
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
} else {
    echo "ID projet non spécifié";
}
?>
