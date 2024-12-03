<?php  session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="loginstyle.css">
</head>
<?php include "include/nav.php" ?>

<body>


<div class="container">
        <form action="" method="post">
        <button type="button" class="btn btn-outline-primary a2 text-dark"><a href="login1.php" class="a3">Vous avez déjà un compte ? Connectez-vous !</a> </button>
          <h2>Créez votre compte</h2>
          <div class="mb-3 mt-3">
                <label for="CIN" class="form-label">CIN :</label>
                <input type="text" class="form-control in1" id="CIN" placeholder="Entrez Code" name="CIN">
                </div>
              <div class="mb-3 mt-3">
                <label for="Nom" class="form-label">Nom :</label>
                <input type="Nom" class="form-control in1" id="Nom" placeholder="Entrez Nom" name="Nom">
                </div>
                <div class="mb-3 mt-3">
                <label for="Prenom" class="form-label">Prenom :</label>
                <input type="Prenom" class="form-control in1" id="Prenom" placeholder="Entrez Prenom" name="Prenom">
                </div>
                <div class="mb-3 mt-3">
                <label for="email" class="form-label">E-mail :</label>
                <input type="email" class="form-control in1" id="email" placeholder="Entrez l'email" name="email">
                </div>
                <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control in1" id="mdp" placeholder="Entez le mot de passe" name="mdp">
                </div>
                <div class="mb-3 mt-3">
                <label for="Adresse" class="form-label">Adresse :</label>
                <input type="Adresse" class="form-control in1" id="Adresse" placeholder="Entrez Adresse" name="Adresse">
                </div>
                <div class="mb-3 mt-3">
                <label for="Tel" class="form-label">Telephone :</label>
                <input type="Tel" class="form-control in1" id="Tel" placeholder="Entrez Telephone" name="Tel">
                </div>
                <div class="form-check mb-3">
                <label class="form-check-label">
                <input class="form-check-input " type="checkbox" name="remember">J'accepte les conditions générales et la politique de confidentialité  </label>
                </div>
            <button type="submit" class="btn btn-primary" >Enregistre</button>
          
        </form><br>
<?php

include_once ("connexionEcom.php");

if (!empty($_POST["CIN"])&&!empty($_POST["Nom"])&&!empty($_POST["Prenom"])&&!empty($_POST["email"])&&!empty($_POST["mdp"])
                              &&!empty($_POST["Adresse"])&&!empty($_POST["Tel"]))
{
//var_dump($_POST);
$query="insert into Client values (:CIN,:Nom,:Prenom,:email,:mdp,:Adresse,:Tel,:CodeC)";
$pdostmt=$connexion->prepare($query);
$pdostmt->execute(["CIN"=>$_POST["CIN"],"Nom"=>$_POST["Nom"],"Prenom"=>$_POST["Prenom"],
                  "email"=>$_POST["email"],"mdp"=>$_POST["mdp"],"Adresse"=>$_POST["Adresse"],"Tel"=>$_POST["Tel"],"CodeC"=>'1']);
            
$pdostmt->closeCursor();  
          echo "<div class='alert alert-success'>Compte créé avec succès. <a href='login1.php'>Connectez-vous</a></div>";
            //header("Location:login1.php");
        } else {
          echo "<div class='alert alert-danger'>Veuillez remplir tous les champs.</div>";
     
}

?>
</div>
</body>
</html>