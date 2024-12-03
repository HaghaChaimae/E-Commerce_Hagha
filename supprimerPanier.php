<?php
  include_once("connexionEcom.php");
session_start();
if (!isset($_SESSION['Client'])) {
    header('location: ajouterClients.php');
}

$idClient = $_SESSION['Client']['CIN'];

$id = $_POST['id'];
unset($_SESSION['panier'][$idClient][$id]);
header("location:".$_SERVER['HTTP_REFERER']);
