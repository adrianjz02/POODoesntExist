<?php

require_once '../vendor/autoload.php';

use App\Router;

$router = new Router();

// Ajouter des routes
$router->addRoute('accueil', 'App\\Controller\\AccueilController');
$router->addRoute('contact', 'App\\Controller\\PostController');

// Définir 'accueil' comme page par défaut si aucune page n'est spécifiée
$page = $_GET['page'] ?? 'accueil';

// Appeler matchRoute avec la page et l'action
$router->matchRoute($page, $_GET['action'] ?? null);
