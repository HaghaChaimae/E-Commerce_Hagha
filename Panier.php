<?php
session_start();

include_once("connexionEcom.php");
include "include/nav.php";

if (!isset($total)) {
    $total = 0;
}

$idClient = $_SESSION['Client']['CIN'] ?? 0;
$panier = $_SESSION['panier'][$idClient] ?? [];

if (!empty($panier)) {
    $Codeproduit = array_keys($panier);
    $Codeproduit = implode(',', $Codeproduit);
    $query = "SELECT * FROM Produits WHERE Codeproduit IN ($Codeproduit)";
    $pdostmt = $connexion->prepare($query);
    $pdostmt->execute();
    $ligne = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
    $pdostmt->closeCursor();
}

if (isset($_POST['valider'])) {
    $query = "INSERT INTO Commande (Montant, DateC, Client) VALUES (:Montant, CURRENT_DATE, :Client)";
    $pdoStmt = $connexion->prepare($query);
    $total = 0;
    $prixProduits = [];

    foreach ($ligne as $Produits) {
        $Codeproduit = $Produits['Codeproduit'];
        $qty = $panier[$Codeproduit];
        $PrixPromo = $Produits['PrixPromo'];
        $total += $qty * $PrixPromo;
        $prixProduits[$Codeproduit] = [
            'id' => $Codeproduit,
            'PrixPromo' => $PrixPromo,
            'total' => $qty * $PrixPromo,
            'qty' => $qty
        ];
    }

    $query = "INSERT INTO panier (Client, CodePrd) VALUES ";
    $args = [];

    foreach ($prixProduits as $Panier) {
        $query .= "(:Client, :CodePrd),";
        $args[':Client'] = $idClient;
        $args[':CodePrd'] = $Panier['id'];
    }
    $query = rtrim($query, ',');
    $pdostmt = $connexion->prepare($query);
    $inserted = $pdostmt->execute($args);

    $pdoStmt->execute(['Montant' => $total, 'Client' => $idClient]);
    $lastInsertId = $connexion->lastInsertId();

    $query = "INSERT INTO DetailCde (CodeCde, CodePrd, Prix, Quantite) VALUES ";
    $args = [];
   
    foreach ($prixProduits as $Produits) {
        $query .= "(:CodeCde, :CodePrd" . $Produits['id'] . ", :PrixPromo" . $Produits['id'] . ", :Quantite" . $Produits['id'] . "),";
       
        $args[':CodePrd' . $Produits['id']] = $Produits['id'];
        $args[':PrixPromo' . $Produits['id']] = $Produits['PrixPromo'];
        $args[':Quantite' . $Produits['id']] = $Produits['qty'];
    }
    $args[':CodeCde'] = $lastInsertId;

    $query = rtrim($query, ',');
    $pdostmt = $connexion->prepare($query);
    $inserted = $pdostmt->execute($args);

    if ($inserted) {
        $_SESSION['panier'][$idClient] = [];
        header('location: panier.php?success=true&total=' . $total . '&comd=' . $lastInsertId);
       
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur (contactez l\'administrateur).</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Panier</title>
</head>
<body>
    <div class="container py-2">
        <h4>Panier(<?php echo count($panier); ?>)</h4>
        <?php
        if (isset($_POST['vider'])) {
            $_SESSION['panier'][$idClient] = [];
            header('location: panier.php');
           
        }

        if (isset($_GET['success'])) {
            ?>
            <h1>Merci ! </h1>
            <div class="alert alert-success" role="alert">
                Votre commande avec le montant <strong>(<?php echo $_GET['total'] ?? 0 ?>) MAD</strong>  est bien ajoutée.
                pour la livraison <a class="btn btn-primary btn-sm" href="livraison.php?comd=<?php echo $_GET['comd']?>"><strong>Livraison</strong></a>
            </div>
            <hr>
            <?php
        }
        ?>

        <div class="container">
            <div class="row">
                <?php
                if (empty($panier)) {
                    if (!isset($_GET['success'])) {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Votre panier est vide ! Commençez vos achats 
                            <a class="btn btn-success btn-sm" href="./index.php">Acheter des produits</a>
                        </div>
                        <?php
                    }
                } else {
                    ?><br><br>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Libelle</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">PrixPromo</th>
                                <th scope="col">total</th>
                            </tr>
                        </thead>
                        <?php
                        $total = 0;
                        foreach ($ligne as $Produits) {
                            $Codeproduit = $Produits['Codeproduit'];
                            $totalProduit = $Produits['PrixPromo']*$panier[$Codeproduit] ;
                            $total += $totalProduit;
                            ?>
                            <tr>
                                <td><?php echo $Produits['Codeproduit'] ?></td>
                                <td><img width="80px" src="<?php echo $Produits['image'] ?>" alt=""></td>
                                <td><?php echo $Produits['Libelle'] ?></td>
                                <td><?php include "include/counter.php" ;?> </td>
                                <td><?php echo $Produits['PrixPromo'] ?> MAD</td>
                                <td><?php echo $totalProduit ?> MAD</td>
            
                            </tr>
                            <?php
                        }
                        ?>
                         
                        <tfoot>
                            <tr>
                                <td colspan="7" align="right"><strong>Total</strong></td>
                                <td><?php echo  $total  ?> MAD </i></td>
                            </tr> 
                            <tr>
                                <td colspan="8" align="right">
                                    <form method="post">
                                        <input type="submit" class="btn btn-success" name="valider" value="Valider la commande">
                                        <input onclick="return confirm('Voulez vous vraiment vider le panier ?')" type="submit"
                                            class="btn btn-danger" name="vider" value="Vider le panier">
                                    
                                        </form>
                                </td>
                            </tr>
                          
                        </tfoot>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php  include "include/contact.php" ; ?>
      <?php  include "include/liver.php" ; ?>
</body>
</html>
