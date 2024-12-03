<?php
  include_once("connexionEcom.php");
$id = $_GET['id'];
$etat = $_GET['etat'];
$query='UPDATE commande SET valide = ? WHERE id = ?';
$pdostmt=$connexion->prepare($query);
$pdostmt->execute([$etat, $id]);
//$pdostmt->execute(["id"=>$_GET["id"],"etat"=>$_GET["etat"]]);
$ligne=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
$pdostmt->closeCursor();

header('location: commande.php?id=' . $id);
?>
