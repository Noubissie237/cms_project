<?php
require('../libs/fpdf.php');
include '../db/db_connect.php'; // Connexion a la base de donnees

// Verifier si l'ID de la facture est passe en paramètre
if (isset($_GET['id'])) {
    $id_facture = $_GET['id'];

    // Requête pour recuperer les informations de la facture ainsi que la description du projet
    $sql = "
        SELECT f.*, p.nom_projet, p.description, c.nom AS nom_client, cons.nom AS nom_consultant, cons.specialite
        FROM factures f
        JOIN projets p ON f.id_projet = p.id_projet
        JOIN clients c ON p.id_client = c.id_client
        JOIN consultants_projets cp ON p.id_projet = cp.id_projet
        JOIN consultants cons ON cp.id_consultant = cons.id_consultant
        WHERE f.id_facture = ?
        LIMIT 1";

    // Preparation et execution de la requête
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_facture);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $facture = $result->fetch_assoc();

        // Création du PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // En-tête de la facture
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode('Consultancy Enterprise'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, utf8_decode('Facture N° ' . $facture['id_facture']), 0, 1, 'C');

        // Informations client et projet
        $pdf->Ln(10); // Saut de ligne
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 10, 'Nom du Client : ' . utf8_decode($facture['nom_client']), 0, 0);
        $pdf->Cell(95, 10, 'Date : ' . date("d/m/Y", strtotime($facture['date_emission'])), 0, 1);
        $pdf->Cell(95, 10, 'Nom du Projet : ' . utf8_decode($facture['nom_projet']), 0, 0);
        $pdf->Cell(95, 10, 'Statut : ' . utf8_decode(ucfirst($facture['statut'])), 0, 1);

        // Affichage de la description du projet
        $pdf->Ln(10); // Saut de ligne
        $pdf->SetFont('Arial', '', 10);

        // Tableau des articles
        $pdf->Ln(10); // Saut de ligne pour espacement
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(90, 10, 'Description', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Prix (FCFA)', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Total', 1, 1, 'C');

        // Exemple de lignes dans la facture (tu peux récupérer ces informations depuis la base de données)
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(90, 10, utf8_decode($facture['description']), 1, 0);
        $pdf->Cell(30, 10, utf8_decode($facture['montant']), 1, 0, 'R');
        $pdf->Cell(40, 10, utf8_decode($facture['montant']), 1, 1, 'R');

        // Pied de page
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, 'Merci de votre confiance.', 0, 1, 'C');

        // Sortie du PDF
        $pdf->Output('I', 'facture_' . $facture['id_facture'] . '.pdf');

    } else {
        echo "Facture non trouvee.";
    }

    $stmt->close();
} else {
    echo "ID facture non specifie.";
}

$conn->close();
?>
