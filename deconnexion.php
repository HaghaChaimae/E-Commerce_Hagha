<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deconnexion</title>
</head>
<body>
   
    
<?php
session_start();
session_unset();
session_destroy();
//header('location: concterGes.php');
header("location:".$_SERVER['HTTP_REFERER']);

    ?>
</body>
</html>