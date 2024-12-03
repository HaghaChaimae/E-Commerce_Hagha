<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouterProduits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include "include/navGes.php" ?>
<?php include_once ("connexionEcom.php");?>

    <div class="container">
    <form method="post" enctype="multipart/form-data">
            <h2>Ajouter Produits</h2>

            <div class="mb-3 mt-3">
                <label for="code" class="form-label">Code:</label>
                <input type="text" class="form-control in1" id="Codeproduit" placeholder="Entrez le Codeproduit" name="Codeproduit" required>
            </div>
            <div class="mb-3">
                <label for="Libelle" class="form-label">Libelle:</label>
                <input type="text" class="form-control in1" id="Libelle" placeholder="Entez le Libelle" name="Libelle" required>
            </div>
            <div class="mb-3">
                <label for="Descritption" class="form-label">Descritption:</label>
                <input type="text" class="form-control in1" name="Descritption" id="Descritption" name="Descritption"  placeholder="Descritption" required>
            </div>
                <div class="mb-3 mt-3">
                <label for="Prix" class="form-label">Prix:</label>
                <input type="number" class="form-control in1" id="Prix" placeholder="Entrez le Prix" name="Prix" min="0" required>
            </div>
            <div class="mb-3">
                <label for="PrixPromo" class="form-label">PrixPromo:</label>
                <input type="number" class="form-control in1" id="PrixPromo" placeholder="Entez le PrixPromo" name="PrixPromo" min="0" required>
            </div>
            <div class="mb-3">
                <label for="Stock" class="form-label">Stock:</label>
                <input type="number" class="form-control in1" id="Stock" placeholder="Entez le Stock" name="Stock" min="0" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">image:</label>
                <input type="file" class="form-control in1" id="image" name="image" required>
            </div>

            <?php
            //$categories = $pdo->query('SELECT * FROM Categorie')->fetchAll(PDO::FETCH_ASSOC);
            $query='SELECT * FROM Categorie';
            $pdostmt=$connexion->prepare($query);
            $pdostmt->execute();
            $ligne=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
            $pdostmt->closeCursor();
            ?>
            <label class="form-label">Catégorie</label>
            <select name="CodeCateg" class="form-control">
            <option value="">Choicategoriesissez une catégorie</option>
            <?php
            foreach ($ligne as $categorie) {
                echo "<option value='" . $categorie['CodeCateg'] . "'>" . $categorie['Libelle'] . "</option>";
            }
            ?>
        </select>
        <br>
            <button type="submit" class="btn btn-primary float-end"  name="ajouter">Ajouter</button>
        </form>
    </div>

<?php
    
    //if (!empty($_FILES["image"]['name'])) 
    //{ move_uploaded_file($_FILES["image"]["tmp_name"],"images/" .$_FILES["image"]["name"]);  
        //var_dump($_FILES);}
     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_FILES["image"]["name"])) {
                // Ensure that the upload directory exists
                if (!is_dir("images")) {
                    mkdir("images");
                }
                $target_file = "images/" . basename($_FILES["image"]["name"]);
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
   
    

    if (!empty($_POST["Codeproduit"])&&!empty($_POST["Libelle"])&&!empty($_POST["Descritption"])&&!empty($_POST["Prix"])
        &&!empty($_POST["PrixPromo"])&&!empty($_POST["Stock"])&&!empty($_POST["CodeCateg"]))

    {
        //var_dump($_POST);
        $query="insert into Produits values (:Codeproduit,:Libelle,:Descritption,:Prix,:PrixPromo,:Stock,:CodeCateg,:image)";
        $pdostmt=$connexion->prepare($query);
        $pdostmt->execute(["Codeproduit"=>$_POST["Codeproduit"],"Libelle"=>$_POST["Libelle"],"Descritption"=>$_POST["Descritption"],
                        "Prix"=>$_POST["Prix"],"PrixPromo"=>$_POST["PrixPromo"],"Stock"=>$_POST["Stock"],"CodeCateg"=>$_POST["CodeCateg"],"image"=>"images/".$_FILES["image"]["name"]]);
        $pdostmt->closeCursor();
         // header("Location:listeProd.php");

    }
?>
        
   
   
</body>
</html>