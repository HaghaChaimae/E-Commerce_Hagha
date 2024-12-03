<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
session_start();
$connecte = false;
if (isset($_SESSION['Gestionnaire'])) {
    $connecte = true;
}

?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        $currentPage = $_SERVER['PHP_SELF'];
        ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == '/e-commerce/Gestionnaire.php') echo 'active' ?>"
                       aria-current="page" href="Gestionnaire.php"><i class="fa-solid fa-home"></i> Ajouter Gestionnaire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage == '/e-commerce/concterGes.php') echo 'active' ?>"
                       aria-current="page" href="concterGes.php"><i class="fa-solid fa-user-plus"></i>
                        conncter Gestionnaire</a>
                </li>
                <?php
                if ($connecte) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/e-commerce/listeCateg.php') echo 'active' ?>"
                           aria-current="page" href="listeCateg.php"><i
                                    class="fa-brands fa-dropbox"></i> Liste des catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/e-commerce/listeProd.php') echo 'active' ?>"
                           aria-current="page" href="listeProd.php"><i class="fa-solid fa-tag"></i>
                            Liste des produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ecommerce/commandes.php') echo 'active' ?>"
                           aria-current="page" href="commandes.php"><i
                                    class="fa-solid fa-barcode"></i> Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="deconnexion.php"><i
                                    class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
                    </li>

                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($currentPage == '/ecommerce/connexion.php') echo 'active' ?>"
                           href="connexion.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Connexion</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <a class="btn float-end" href="front/"><i class="fa-solid fa-cart-shopping"></i> Site front</a>
    </div>
</nav>
</body>
</html>