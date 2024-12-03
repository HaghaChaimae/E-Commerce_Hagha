<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php include "include/navGes.php" ?>
<div class="container py-2">
        <?php
            include_once("connexionEcom.php");
            //session_start();
            if(!isset($_SESSION['Gestionnaire'])){
            header('location: Gestionnaire.php');  
            //echo'acees refuse';
            }
           
        ?>
            <h3> Bonjour <?php echo( $_SESSION['Gestionnaire']['CodeGes'])?>  </h3>

                
          
    </div>
    <?php


if(!isset($_SESSION['Gestionnaire'])){
    header('location: Gestionnaire.php');  
}

$query = "SELECT COUNT(*) as total_products FROM Produits";
$pdostmt = $connexion->prepare($query);
$pdostmt->execute();
$result = $pdostmt->fetch(PDO::FETCH_ASSOC);
$total_products = $result['total_products'];
$pdostmt->closeCursor();



$query = "SELECT COUNT(*) as total_Categorie FROM Categorie";
$pdostmt = $connexion->prepare($query);
$pdostmt->execute();
$ligne = $pdostmt->fetch(PDO::FETCH_ASSOC);
$total_Categorie = $ligne['total_Categorie'];
$pdostmt->closeCursor();


$query = "SELECT COUNT(*) as total_Client FROM Client";
$pdostmt = $connexion->prepare($query);
$pdostmt->execute();
$lignes = $pdostmt->fetch(PDO::FETCH_ASSOC);
$total_Client = $lignes['total_Client'];
$pdostmt->closeCursor();


$query = "SELECT COUNT(*) as total_Commande FROM Commande";
$pdostmt = $connexion->prepare($query);
$pdostmt->execute();
$resulta = $pdostmt->fetch(PDO::FETCH_ASSOC);
$total_Commande = $resulta['total_Commande'];
$pdostmt->closeCursor();
?>

<div class="container my-5">
 
  
  <div class="d-flex justify-content-center">
    <div class="card p-4 shadow-sm">
      <div class="card-body">
        <h3 class="card-title" id="product-count"><?php echo $total_products; ?></h3>
        <p class="card-text">Produits disponibles <i class="fa-solid fa-tag"></i></p>
      </div>
    </div><br><br><br>
    

    
  <div class="d-flex justify-content-center">
    <div class="card p-4 shadow-sm">
      <div class="card-body">
        <h3 class="card-title" id="Categorie-count"><?php echo $total_Categorie; ?></h3>
        <p class="card-text">Categorie disponibles <i class="fa-solid fa-layer-group"></i></p>
      </div>
    </div>
  </div>

  <br><br><br>
  <div class="d-flex justify-content-center">
    <div class="card p-4 shadow-sm">
      <div class="card-body">
        <h3 class="card-title" id="Client-count"><?php echo $total_Client; ?></h3>
        <p class="card-text">Client disponibles <i class="fa-solid fa-user"></i></p>
      </div>
    </div>
  </div>

<br><br><br>
  <div class="d-flex justify-content-center">
    <div class="card p-4 shadow-sm">
      <div class="card-body">
        <h3 class="card-title" id="Categorie-count"><?php echo $total_Commande; ?></h3>
        <p class="card-text">Commande disponibles <i class="fa-solid fa-barcode"></i></p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<style>
    /* Bootstrap CSS */
@import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}
.card {
  width: 200px;
  text-align: center;
  border: none;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  margin:30px;
}

.card-title {
  font-size: 3rem;
  font-weight: bold;
}

.card-text {
  font-size: 1.2rem;
  color: #666;
}
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

#product-count,
#Categorie-count,
#Client-count {
  color: #007bff;
}
</style>