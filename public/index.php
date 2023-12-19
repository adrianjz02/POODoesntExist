<?php
// CONTROLEUR FRONTAL
// http://localhost/PooDoesntExist/?page=post&action=create

require_once '../vendor/autoload.php';

use App\Router;

$router = new Router();

$router->addRoute('contact', 'AccueilController');
$router->addRoute('accueil', 'ContactController');

$router->matchRoute($_GET['page'], $_GET['action'] ?? null);