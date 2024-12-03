<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="loginstyle.css">
  <?php include "include/nav.php" ?>
</head>
<body>
<?php
   
    include_once("connexionEcom.php");

    if(isset($_POST["envoi"])){
        $identifiant = $_POST['email'];
        $password =$_POST['mdp'];
        $req=$connexion->prepare('select * from Client where email=? and mdp=?');
        $req-> execute(array($identifiant,$password));
        if ($req->rowCount()>0){
            header("location:index.php");
            session_start();
            $idClient = $req->fetch(PDO::FETCH_ASSOC); 
            $_SESSION['Client'] = $idClient; 
            ?>
                <div class="alert alert-info" role="alert">
                  votre compte est active
                </div>
            <?php
        }
       else {
            ?>
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              Login ou password incorrectes !!
            </div>
            <?php
        }
    }
    ?>

<div class="container">
        <form action="" method="post">
            <h2>Connectez-vous à votre compte</h2>

            <div class="mb-3 mt-3">
                <label for="email" class="form-label">E-mail :</label>
                <input type="email" class="form-control in1" id="email" placeholder="Entrez l'email" name="email">
                </div>
                <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control in1" id="mdp" placeholder="Entez le mot de passe" name="mdp">
                </div>
                <a href="#" class="a1">Mot de passe oublié ?</a><br><br>
                <button type="submit" class="btn btn-primary" name="envoi">Concter</button>
                <button type="button" class="btn btn-outline-primary a2 " name="envoi"><a href="ajouterClients.php" class="a3">Pas de compte ? Créez-en un </a> </button>
        </div>

        
</body>
</html>