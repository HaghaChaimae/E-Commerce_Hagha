<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Categorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include "include/navGes.php" ?>
    <div class="container">
        <form action="" method="post">
            <h2>Ajouter Categorie</h2>

            <div class="mb-3 mt-3">
                <label for="code" class="form-label">Code:</label>
                <input type="text" class="form-control in1" id="CodeCateg" placeholder="Entrez le CodeCateg" name="CodeCateg">
            </div>
            <div class="mb-3">
                <label for="Libelle" class="form-label">Libelle:</label>
                <input type="text" class="form-control in1" id="Libelle" placeholder="Entez le Libelle" name="Libelle">
           </div>
           <button type="submit" class="btn btn-primary float-end">Ajouter</button>
        </form>
    </div>
    <?php
    
    include_once ("connexionEcom.php");
    
    if (!empty($_POST["CodeCateg"])&&!empty($_POST["Libelle"]))
    {
    //var_dump($_POST);
    $query="insert into Categorie values (:CodeCateg,:Libelle)";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["CodeCateg"=>$_POST["CodeCateg"],"Libelle"=>$_POST["Libelle"]]);        
    $pdostmt->closeCursor();
    header("Location:listeCateg.php");
     } 
    
     ?>
</body>
</html>