<?php
include '../db/db_connect.php'; // Connexion à la base de données

if (isset($_GET['id_consultant']) && isset($_GET['id_projet'])) {
    $id_consultant = $_GET['id_consultant'];
    $id_projet = $_GET['id_projet'];

    // Suppression de la relation consultant-projet
    $sql = "DELETE FROM consultants_projets WHERE id_consultant = $id_consultant AND id_projet = $id_projet";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Consultant-Projet supprimé avec succès.'); window.location.href = 'list_consultants_projets.php';</script>";
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }
} else {
    echo "ID consultant ou projet manquant.";
}
?>
