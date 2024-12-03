<?php
include_once("connexionEcom.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
</head>
<body>
<?php include 'include/navGes.php' ?>
<div class="container py-2">
    <h2>Les Commandes</h2>
    <table  class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Client</th>
                <th>Code de commande</th>
                <th>Montant</th>
                <th>DateC</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
     
        <?php
        //$query = "SELECT * FROM Commande";
        $query = "SELECT * FROM Commande ORDER BY Commande.DateC DESC";
        
        $pdostmt = $connexion->prepare($query);
        $pdostmt->execute();
        $linge = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
        $pdostmt->closeCursor();
        
        foreach ($linge as $commande) {
            ?>
            <tr> 
              <td><?php echo $commande['Client'] ?></td>
            <td><?php echo $commande['CodeCde'] ?></td>
            <td><?php echo $commande['Montant'] ?>MAD</td>
            <td><?php echo $commande['DateC'] ?></td>
            <td><a class="btn btn-primary btn-sm" href="Detailcommandes.php?CodeCde=<?php echo $commande['CodeCde']?>">Afficher détails</a></td>
            </tr>
            <?php
        }
        ?>
           
        </tbody>
    </table>
</div>
</body>
</html>
