<?php
session_start();

 include "include/nav.php" ;
include_once ("connexionEcom.php");
    $CodeCateg=$_GET['CodeCateg'];
    $query="SELECT * FROM Categorie  WHERE CodeCateg = :CodeCateg ";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(['CodeCateg'=>$CodeCateg]);
    $ligne=$pdostmt->fetch(PDO::FETCH_ASSOC);
    $pdostmt->closeCursor();
    //var_dump($ligne);


   

    $query="SELECT * FROM Produits  WHERE CodeCateg = :CodeCateg ";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(['CodeCateg'=>$CodeCateg]);
    $lign=$pdostmt->fetchALL(PDO::FETCH_OBJ);
    $pdostmt->closeCursor();
    //var_dump($lign);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Categorie | <?php echo $ligne ['Libelle'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="card.css">
  
   
</head>
<body>

    <div class="container py-2">
        
        <h4><?php echo $ligne ['Libelle'] ?></h4>
    </div>
      <div class="contienr">
          <div class="row">
            <?php
            foreach ($lign as $Produits) {
                $Codeproduit=$Produits->Codeproduit
            ?>
            
                <div class="card mb-3 col-sm-3  card">
                    <img class="card-img-top w-75  mx-auto img" src="<?= $Produits->image ?>"height="200px" >
                    <div class="card-body">
                    <a href="Produit.php?Codeproduit=<?php echo $Produits ->Codeproduit ?>" class='btn stretched-link'></a>
                    <h3 class="card-title"><?php echo $Produits -> Libelle ?></h3>
                    <h6 class="card-text"><?php echo $Produits -> Descritption ?>.</h6>
                    <strike><h5 class="card-text prixPromo"><small><?php echo $Produits -> Prix?> MAD</small></h5></strike>
                    <h4 class="card-text"><?php echo $Produits -> PrixPromo  ?> MAD</h4>
                </div>
                <div class="card-footer" style="z-index :10">
                <?php include "include/counter.php" ;?>
                </div>
                </div>
                <?php
        }
    ?> 
     <?php

if (empty($lign)) {
    ?>
    <div class="alert alert-info" role="alert">
        Pas de produits pour l'instant
    </div>

    <?php
}
?>
         </div>
      </div>
      <ul class="pagination pag">
            <li class="page-item "><a class="page-link" href="#">Précédent</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
            </ul><br><br>



            <?php  include "include/contact.php" ; ?>
           <?php  include "include/liver.php" ; ?>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="counter.js"></script>
</body>
</html>