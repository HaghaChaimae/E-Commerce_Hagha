<?php
include_once("connexionEcom.php");
include "include/navGes.php" ;
$query = "SELECT * FROM Livraison";
$pdostmt = $connexion->query($query);
$livraisons = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
$pdostmt->closeCursor();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title> livraison</title>
    
   
</head>
<body>
<div class="container py-2">
<h2> livraison</h2>

<table id="example" class="table table-striped table-hover" style="width:100%">
        <thead>
        <tr>
            <th>id</th>
            <th>date_livraison </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($livraisons as $Livraison) : ?>
            <tr>
                <td><?php echo $Livraison['CodeCde']; ?></td>
                <td><?php echo $Livraison['DateL']; ?></td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        </div>
</body>
</html>
