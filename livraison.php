<?php
session_start();
include "include/nav.php" ;
include_once("connexionEcom.php");
if (!isset($_SESSION['Client'])) {
    header('location: login1.php');
}

$Client = $_SESSION['Client'];
$comd = $_GET['comd'] ?? 0;

$query = "INSERT INTO Livraison (CodeCde, DateL) VALUES (:CodeCde, CURRENT_DATE) ";
$pdostmt = $connexion->prepare($query);
$pdostmt->execute([':CodeCde' => $comd]);


if ($pdostmt->rowCount() > 0) {
    echo "<div class='alert alert-success'>Livraison acceptée pour {$Client['Nom']}. <a class='btn btn-primary btn-sm' href='PDF/fpdf.php?comd={$comd} ' name='envoi'><strong>Facture</strong></a></div> ";
} else {
    echo "<br><div class='alert alert-danger'>Une erreur s'est produite lors de l'acceptation de la livraison.</div>";
}

//var_dump($comd); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="loginstyle.css">
    <title>Livraison</title>
</head>
<body>
<?php  include "include/contact.php" ; ?>
      <?php  include "include/liver.php" ; ?>


</body>
</html>
