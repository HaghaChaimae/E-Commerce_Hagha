<?php
include_once("connexionEcom.php");

if (isset($_GET['CodeCde'])) {
    $CodeCde = $_GET['CodeCde'];
    
    $query = "SELECT Commande.*, Client.CIN as 'CIN' FROM Commande 
              INNER JOIN Client ON Commande.Client = Client.CIN 
              WHERE Commande.CodeCde = :CodeCde
              ORDER BY Commande.DateC DESC";
    
    $pdostmt_Commande = $connexion->prepare($query);
    $pdostmt_Commande->execute(['CodeCde' => $CodeCde]);
    $commande = $pdostmt_Commande->fetch(PDO::FETCH_ASSOC);
    $pdostmt_Commande->closeCursor();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande | Numéro <?= $commande['CodeCde'] ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include 'include/navGes.php'; ?>
<div class="container py-2">
    <h2>Détails Commandes</h2>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Code de commande</th>
                <th>Client</th>
                <th>Montant</th>
                <th>Date</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = 'SELECT DetailCde.*, Produits.Libelle, Produits.image 
                      FROM DetailCde
                      INNER JOIN Produits ON DetailCde.CodePrd = Produits.Codeproduit
                      WHERE CodeCde = :CodeCde';
           
            $pdostmt = $connexion->prepare($query);
            $pdostmt->execute(['CodeCde' => $CodeCde]);
            $lignes = $pdostmt->fetchAll(PDO::FETCH_OBJ);
            $pdostmt->closeCursor();
            ?>
            <tr> 
                <td><?php echo $commande['CodeCde'] ?></td> 
                <td><?php echo $commande['Client'] ?></td>
                <td><?php echo $commande['Montant'] ?> MAD</td>
                <td><?php echo $commande['DateC'] ?></td>
                <td><a class="btn btn-primary btn-sm" href="commande.php">Liste de commande</a></td>
                <td>
                    <?php if ($commande['valide'] == 0) : ?>
                        <a class="btn btn-success btn-sm" href="validerCommande.php?id=<?= $commande['CodeCde'] ?>&etat=1">Valider la commande</a>
                    <?php else: ?>
                        <a class="btn btn-danger btn-sm" href="validerCommande.php?id=<?= $commande['CodeCde'] ?>&etat=0">Annuler la commande</a>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <h2>Produits : </h2>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lignes as $DetailCde) : ?>
            <tr>
                <td><?php echo $DetailCde->CodePrd ?></td>
                <td><?php echo $DetailCde->Libelle ?></td>
                <td><?php echo $DetailCde->Prix ?> MAD</td>
                <td>x <?php echo $DetailCde->Quantite ?></td>
                <td><?php echo $DetailCde->Prix * $DetailCde->Quantite ?> MAD</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
