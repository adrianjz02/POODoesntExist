<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__ . '/index.html';
        break;
    case '':
        require __DIR__ . '/index.html';
        break;
    // Ajoutez d'autres cas ici pour d'autres routes
    default:
        http_response_code(404);
        require __DIR__ . '/404.html'; // Assurez-vous d'avoir un fichier 404.html
        break;
}