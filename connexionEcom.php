<?php
$host = 'localhost'; 
$dbname = 'Ecommerce'; 
$username = 'root'; 
$password = 'root';  
try {
$connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//echo "Connexion etablie avec succes" ;
} 
catch (PDOException $e) 
{
die("Impossible de se connecter à la base de donnée $dbname :" . $e->getMessage());
}

?>