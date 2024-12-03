<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    

<?php
include_once("connexionEcom.php");

if (!empty($_GET["id"])) 
{
    $query="select CodeCateg,Libelle from Categorie where CodeCateg=:CodeCateg";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["CodeCateg"=>$_GET["id"]]);
    $ligne=$pdostmt->fetch(PDO::FETCH_ASSOC);
    $pdostmt->closeCursor();
}
?>
<h2>Modifier Categorie</h2>
<div class="container">
        <form action="" method="post">
            <input type="hidden" name="saveId" class="form-control" value=<?php echo $ligne["CodeCateg"] ?>>
            <div class="mb-3">
                <label for="Libelle" class="form-label">Libelle:</label>
                <input type="text" class="form-control in1" id="Libelle" placeholder="Entez le Libelle" name="Libelle"  value=<?php echo $ligne["Libelle"] ?>>
            
            <br><button type="submit" class="btn btn-primary float-end">Modifier</button>
        </form>
    </div>

    <?php
if (!empty($_POST))
{
    $query="update Categorie set Libelle=:Libelle  where CodeCateg=:id";
    //var_dump($query);
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["Libelle"=>$_POST["Libelle"],"id"=>$_POST["saveId"]]);
    $pdostmt->closeCursor();
     header($header='Location:listeCateg.php');
}
?>


</body>
</html>