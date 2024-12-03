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
    $query="select Codeproduit,Libelle,Descritption,Prix,PrixPromo,Stock,CodeCateg,image  from Produits where Codeproduit=:Codeproduit";
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["Codeproduit"=>$_GET["id"]]);
    $ligne=$pdostmt->fetch(PDO::FETCH_ASSOC);
    $pdostmt->closeCursor();
}
?>

<div class="container">
    <h2>Ajouter Produits</h2>
        <form action="" method="post">
            <input type="hidden" name="saveId" class="form-control" value=<?php echo $ligne["Codeproduit"] ?>>
            <div class="mb-3">
                <label for="Libelle" class="form-label">Libelle:</label>
                <input type="text" class="form-control in1" id="Libelle" placeholder="Entez le Libelle" name="Libelle"  value=<?php echo $ligne["Libelle"] ?>>
            </div>
            <div class="mb-3">
                <label for="Descritption" class="form-label">Descritption:</label>
                <input type="text" class="form-control in1" name="Descritption" id="Descritption" name="Descritption"  placeholder="Descritption"  value=<?php echo $ligne["Descritption"] ?>>
            </div> 
            <div class="mb-3 mt-3">
                <label for="Prix" class="form-label">Prix:</label>
                <input type="number" class="form-control in1" id="Prix" placeholder="Entrez le Prix" name="Prix" min="0" value=<?php echo $ligne["Prix"] ?>>
         </div>
            <div class="mb-3">
                <label for="PrixPromo" class="form-label">PrixPromo:</label>
                <input type="number" class="form-control in1" id="PrixPromo" placeholder="Entez le PrixPromo" name="PrixPromo" min="0"   value=<?php echo $ligne["PrixPromo"] ?>>
            </div>
            <div class="mb-3">
                <label for="Stock" class="form-label">Stock:</label>
                <input type="number" class="form-control in1" id="Stock" placeholder="Entez le Stock" name="Stock" min="0"  value=<?php echo $ligne["Stock"] ?>>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">photo:</label>
                <input type="file" class="form-control in1" id="image" name="image"  value=<?php echo $ligne["image"] ?>>
            </div>
              <?php
            $query='SELECT * FROM Categorie';
            $pdostmt=$connexion->prepare($query);
            $pdostmt->execute();
            $ligne=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
            $pdostmt->closeCursor();
            ?>
            <label class="form-label">Catégorie</label>
            <select name="CodeCateg" class="form-control">
                    <option value="">Choisissez une catégorie</option>
                    <?php  
                        foreach ($ligne as $categorie) {
                            echo "<option value='" . $categorie['CodeCateg'] . "'>" . $categorie['Libelle'] . "</option>"; }
                    ?>
            </select>
            <button type="submit" class="btn btn-primary float-end">Modifier</button>
        </form>
    </div>

    <?php

    
if (!empty($_POST))
{
    
    $query="update Produits set Libelle=:Libelle,Descritption=:Descritption,Prix=:Prix,PrixPromo=:PrixPromo,Stock=:Stock,
            CodeCateg=:CodeCateg,image=:image where Codeproduit=:id";
    //var_dump($query);
    $pdostmt=$connexion->prepare($query);
    $pdostmt->execute(["Libelle"=>$_POST["Libelle"],"Descritption"=>$_POST["Descritption"],"Prix"=>$_POST["Prix"],"PrixPromo"=>$_POST["PrixPromo"],
                    "Stock"=>$_POST["Stock"],"CodeCateg"=>$_POST["CodeCateg"],"image"=>$_POST["image"],"id"=>$_POST["saveId"]]);
    $pdostmt->closeCursor();
      header("Location:listeProd.php");

}
?>


</body>
</html>