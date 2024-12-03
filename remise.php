<?php
include_once("connexionEcom.php");

$query = "SELECT * FROM CategoriesClients";
$pdostmt = $connexion->prepare($query);
$pdostmt->execute();
$categories = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($categories)
// استخدم $categories لعرض أو التعامل مع البيانات في تطبيقك
?>
