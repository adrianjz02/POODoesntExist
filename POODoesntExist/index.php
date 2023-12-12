<?php

require_once 'root.php'; // Assurez-vous que le nom du fichier est correct.

$router = new Rooter();

// Ajouter des routes
$router->add('/contact.html', 'handler');

// Exécuter le routeur
$router->run();
?>
