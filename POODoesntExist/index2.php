<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php

    require_once 'Routeur.php';

    // Récupérez l'URL demandée
    $pageDemandee = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : '';

    // Utilisation de la classe Routeur avec une instance
    $routeur = new Routeur($pageDemandee);
    $routeur->route();

    ?>

</body>

</html>