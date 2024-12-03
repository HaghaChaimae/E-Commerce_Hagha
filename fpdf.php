<?php
session_start();
// Inclusion de la bibliothèque FPDF
require('fpdf/fpdf.php');

// Création d'une nouvelle classe PDF en héritant de la classe FPDF
class PDF extends FPDF {
    // Méthode pour l'en-tête du PDF
    function Header() {
        // Paramètres de l'image : retrait gauche, retrait haut, largeur, hauteur 
        $this->Image('Capture d’écran (80).png',10,10,30);
        // Police du texte de l'en-tête 
        $this->SetFont('Arial',"B",17);
        // Retrait à gauche
        $this->Cell(80);
        // Dimensions de la cellule : largeur, hauteur, texte, 1 pour le cadre (autre valeur pour enlever le cadre),
        $this->Cell(50,10,'FACTURE',1,5,'C');
        
        // Définition de la police et de la taille du texte
        $this->SetFont('Times',"I",12);
        // Retrait à gauche
        $this->Cell(100,10,'Date: '.date('d/m/y',time()),0,0,'R');
        // Espacement après l'en-tête
        $this->Ln(20);
    }

    // Méthode pour le pied de page du PDF
    function Footer() {
        // La distance par rapport au pied de page
        $this->SetY(-20);
        // Police et taille du texte du pied de page
        $this->SetFont('Arial',"I",10);
        // Afficher le numéro de la page / nombre total de pages, centré 'C'
        $this->Cell(0,10,"Page ".$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Création d'une instance de la classe PDF
$pdf = new PDF();
$pdf->AliasNbPages(); // Ajoute un alias pour le nombre total de pages

// Ajout d'une nouvelle page
$pdf->AddPage();

// Définition de la police et de la taille du texte
$pdf->SetFont('Arial','',12);

// Titre
$pdf->Cell(0,10,'Facture de commande',0,1,'C');
$pdf->Ln(10);

// En-tête du tableau
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'Code produit',1,0,'C');
$pdf->Cell(80,10,'Libelle',1,0,'C');
$pdf->Cell(30,10,'Quantite',1,0,'C');
$pdf->Cell(40,10,'Prix unitaire',1,0,'C');
$pdf->Cell(40,10,'Total',1,1,'C');

// Contenu du tableau (récupération des données du panier)
$totalAmount = 0;
foreach ($ligne as $Produits) {
    $Codeproduit = $Produits['Codeproduit'];
    $qty = $panier[$Codeproduit];
    $PrixPromo = $Produits['PrixPromo'];
    $totalProduit = $qty * $PrixPromo;
    $totalAmount += $totalProduit;

    // Ajout des données dans le tableau du PDF
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(30,10,$Codeproduit,1,0,'C');
    $pdf->Cell(80,10,$Produits['Libelle'],1,0,'C');
    $pdf->Cell(30,10,$qty,1,0,'C');
    $pdf->Cell(40,10,$PrixPromo,1,0,'C');
    $pdf->Cell(40,10,$totalProduit,1,1,'C');
}

// Total
$pdf->Cell(160,10,'Total',1,0,'C');
$pdf->Cell(40,10,$totalAmount,1,1,'C');

// Sortie du PDF
$pdf->Output('facture.pdf','D');
?>
