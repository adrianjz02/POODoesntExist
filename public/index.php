<?php

require_once '../vendor/autoload.php';

use App\Router;

$router = new Router();

// Add routes
$router->addRoute('accueil', 'App\\Controller\\AccueilController');
$router->addRoute('contact', 'App\\Controller\\PostController');

// Default to 'accueil' if no page is set
$page = $_GET['page'] ?? 'accueil';

// Call matchRoute with the page and action
$router->matchRoute($page, $_GET['action'] ?? null);
