<?php

    session_start();
    include "include/nav.php" ;
    include_once ("connexionEcom.php");
    $Codeproduit=$_GET['Codeproduit'];
    $query="SELECT * FROM Produits  WHERE Codeproduit = :Codeproduit ";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(['Codeproduit'=>$Codeproduit]);
    $ligne=$pdostmt->fetch(PDO::FETCH_ASSOC);
    $pdostmt->closeCursor();
    //var_dump($ligne);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Produits | <?php echo $ligne ['Libelle'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="produit.css">
   
    
    
</head>
<body>
    <div class="container py-2">
        <h4><?php echo $ligne ['Libelle'] ?></h4>
    </div>
    <div class="contienr">
          <div class="row">
            <div class="col-md-6">
                <img class="img img-fluid w-75   mx-auto" src="<?php echo $ligne ['image'] ?>"height="100px" alt="<?php echo $ligne ['Libelle'] ?>">
            </div>
            <div class="col-md-6">
                
                <h3><?php echo $ligne ['Libelle'] ?></h3>
                <hr>
                <h6><?php echo $ligne ['Descritption'] ?></h6>
                <hr>
                <strike><h5><?php echo $ligne ['Prix'] ?> MAD</h5></strike>
                <hr>
                <h4><?php echo $ligne ['PrixPromo'] ?> MAD</h4>
                <hr>
                <?php include "include/counter.php" ;?>
                <hr>
               
            </div>
           
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="counter.js"></script>

    <?php  include "include/contact.php" ; ?>
      <?php  include "include/liver.php" ; ?>
</body>
</html>