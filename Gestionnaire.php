<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
        <div class="container-fluid">
           
            <ul class="navbar-nav">
               <li class="nav-item active"><a class="nav-link" href="Gestionnaire.php">Ajouter Gestionnaire</a></li>
                <li class="nav-item"><a class="nav-link" href="concterGes.php">concter Gestionnaire</a></li>
                
            </ul>
        </div>
    </nav>
    <div class="container">
            <form action="" method="post">
                <h2>Ajouter Gestionnaire</h2>

                <div class="mb-3 mt-3">
                    <label for="CodeGes" class="form-label">Code:</label>
                    <input type="text" class="form-control in1" id="CodeGes" placeholder="Entrez votre Code" name="CodeGes">
                </div>
                <div class="mb-3">
                    <label for="Nom" class="form-label">Nom:</label>
                    <input type="text" class="form-control in1" id="Nom" placeholder="Entez votre Nom" name="Nom">
                </div>
                <div class="mb-3 mt-3">
                    <label for="Prenom" class="form-label">Prenom:</label>
                    <input type="text" class="form-control in1" id="Prenom" placeholder="Entrez votre Prenom" name="Prenom">
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe:</label>
                    <input type="password" class="form-control in1" id="mdp" placeholder="Entez votre password" name="mdp">
                </div>
                <button type="submit" class="btn btn-primary float-end">Connecter</button>
            </form>
    </div>
        

<?php
    include_once ("connexionEcom.php");
    
    if (!empty($_POST["CodeGes"])&&!empty($_POST["Nom"])&&!empty($_POST["Prenom"])&&!empty($_POST["mdp"]) )
    {
    //var_dump($_POST);
    $query="insert into Gestionnaire values (:CodeGes,:Nom,:Prenom,:mdp)";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["CodeGes"=>$_POST["CodeGes"],"Nom"=>$_POST["Nom"],"Prenom"=>$_POST["Prenom"],"mdp"=>$_POST["mdp"]]);      
    $pdostmt->closeCursor();
    header("Location:Gestionnaire.php");
   
     }
     ?>
</body>
</html>