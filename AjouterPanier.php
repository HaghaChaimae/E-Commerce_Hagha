<?php
  include_once("connexionEcom.php");
session_start();
if (!isset($_SESSION['Client'])) {
    header('location: ajouterClients.php');
}

$id = $_POST['id'];
$qty = $_POST['qty'];
$idClient = $_SESSION['Client']['CIN'];
if (!isset($_SESSION['panier'][$idClient])) {
    $_SESSION['panier'][$idClient] = [];
}
if($qty == 0){
    unset($_SESSION['panier'][$idClient][$id]);
}else{
    $_SESSION['panier'][$idClient][$id] = $qty;
}
//var_dump($_SESSION['panier']);

header("location:".$_SERVER['HTTP_REFERER']);


