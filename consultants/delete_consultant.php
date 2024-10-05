<?php
include '../db/db_connect.php'; // Inclure la connexion à la base de données

// Vérifier si l'ID du consultant est passé en paramètre
if (isset($_GET['id'])) {
    $id_consultant = $_GET['id'];

    // Suppression du consultant dans la base de données
    $sql = "DELETE FROM consultants WHERE id_consultant = $id_consultant";

    if ($conn->query($sql) === TRUE) {
        echo "Consultant supprimé avec succès";
    } else {
        echo "Erreur de suppression : " . $conn->error;
    }
}

// Redirection vers la liste des consultants après la suppression
header("Location: list_consultants.php");
exit;
