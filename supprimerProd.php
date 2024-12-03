<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Produits</title>
</head>
<body>
<?php
include_once ("connexionEcom.php");

if(!empty($_GET["id"]))
{
    $query="delete from Produits where Codeproduit=:code";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["code"=>$_GET["id"]]);
    $pdostmt->closeCursor();
    header("Location:listeProd.php"); 
}
?>
</body>
</html>