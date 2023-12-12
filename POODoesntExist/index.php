<?php

// Inclure la définition de la classe Router ici ou dans un fichier séparé

$router = new Router();

// Ajouter des routes
$router->add('', function () {
    require __DIR__ . '/index.html';
});

$router->add('contact', function () {
    require __DIR__ . '/contact.php';
});

// D'autres routes peuvent être ajoutées ici.

// Exécuter le routeur
$router->run();

?>