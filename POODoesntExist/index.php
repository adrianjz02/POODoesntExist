<?php

require_once 'root.php'; // Assurez-vous que le nom du fichier est correct.

$router = new Router();

// Ajouter des routes
$router->add('', function () {
    require __DIR__ . '/contact.html';
});

$router->add('contact', function () {
    require __DIR__ . '/contact.php';
});

// D'autres routes peuvent être ajoutées ici.

// Exécuter le routeur
$router->run();
?>