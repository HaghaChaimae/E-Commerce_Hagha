<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php include "include/navGes.php";?>
<?php
include_once("connexionEcom.php");

if (!empty($_GET["id"])) 
{
    $query="select CIN,Nom,Pernom,email,mdp,Adresse,Tel,CodeC from Client where CIN=:CIN";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["CIN"=>$_GET["id"]]);
    $ligne=$pdostmt->fetch(PDO::FETCH_ASSOC);
    $pdostmt->closeCursor();
}
?>
<h2>Modifier Clients</h2>
<div class="container">
        <form action="" method="post">
            <input type="hidden" name="saveId" class="form-control" value="<?php echo $ligne["CIN"]; ?>">
            <div class="mb-3 mt-3">
                <label for="Nom" class="form-label">Nom :</label>
                <input type="text" class="form-control in1" id="Nom" placeholder="Entrez Nom" name="Nom" value="<?php echo $ligne["Nom"]; ?>">
                </div>
                <div class="mb-3 mt-3">
                <label for="Pernom" class="form-label">Prenom :</label>
                <input type="text" class="form-control in1" id="Pernom" placeholder="Entrez Prenom" name="Pernom" value="<?php echo $ligne["Pernom"]; ?>">
                </div>
                <div class="mb-3 mt-3">
                <label for="email" class="form-label">E-mail :</label>
                <input type="email" class="form-control in1" id="email" placeholder="Entrez l'email" name="email" value="<?php echo $ligne["email"]; ?>">
                </div>
                <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control in1" id="mdp" placeholder="Entez le mot de passe" name="mdp" value="<?php echo $ligne["mdp"]; ?>">
                </div>
                <div class="mb-3 mt-3">
                <label for="Adresse" class="form-label">Adresse :</label>
                <input type="text" class="form-control in1" id="Adresse" placeholder="Entrez Adresse" name="Adresse"value="<?php echo $ligne["Adresse"]; ?>">
                </div>
                <div class="mb-3 mt-3">
                <label for="Tel" class="form-label">Telephone :</label>
                <input type="text" class="form-control in1" id="Tel" placeholder="Entrez Telephone" name="Tel"value="<?php echo $ligne["Tel"]; ?>">
                </div>
                <?php
            $query='SELECT CodeC, Libelle FROM Categorieclients';
            $pdostmt=$connexion->prepare($query);
            $pdostmt->execute();
            $categories=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
            $pdostmt->closeCursor();
            ?>
            <label class="form-label">Catégorie</label>
            <select name="CodeC" class="form-control">
                <option value="">Choisissez une catégorie</option>
                <?php
                foreach ($categories as $Categorieclients) {
                    $selected = ($Categorieclients['CodeC'] == $ligne['CodeC']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($Categorieclients['CodeC']) . "' $selected>" . htmlspecialchars($Categorieclients['Libelle']) . "</option>";
                }
                ?>
            </select>
        
        <br>
            <br><button type="submit" class="btn btn-primary float-end">Modifier</button>
        </form>
    </div>

    <?php
if (!empty($_POST))
{
    $query="update Client set Nom=:Nom,Pernom=:Pernom,email=:email,mdp=:mdp,Adresse=:Adresse,Tel=:Tel,CodeC=:CodeC where CIN=:id";
    //var_dump($query);
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["Nom"=>$_POST["Nom"],"Pernom"=>$_POST["Pernom"],
    "email"=>$_POST["email"],"mdp"=>$_POST["mdp"],"Adresse"=>$_POST["Adresse"],"Tel"=>$_POST["Tel"],"CodeC" => $_POST["CodeC"],"id"=>$_POST["saveId"]]);
    $pdostmt->closeCursor();
     //header("Location:listeClient.php"); 
}
?>
</body>
</html>
