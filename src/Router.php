<?php

namespace App;

use App\Controller\AccueilController;
use App\Controller\ContactController;
use App\Controller\PostController;

final class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->addRoute('accueil', 'App\\Controller\\AccueilController');
        $this->addRoute('contact', 'App\\Controller\\PostController');
        // Ajouter la route pour le formulaire de création de commande
        $this->addRoute('commande_create', 'App\\Controller\\CommandeController');

        // Ajouter la route pour la soumission de la création de commande
        $this->addRoute('commande_store', 'App\\Controller\\CommandeController');
    }
    public function addRoute(string $name, string $controller): void
    {
        $this->routes[$name] = $controller;
    }

    public function matchRoute(?string $name, ?string $action = 'show'): bool
    {
        try {
            $name = $name ?? 'accueil'; // Default to 'accueil' if no page is set

            if (key_exists($name, $this->routes)) {
                $controllerClass = $this->routes[$name];
            } else {
                throw new \Exception("Page not found: $name");
            }

            if (!class_exists($controllerClass)) {
                throw new \Exception("Controller not found: $controllerClass");
            }

            $controller = new $controllerClass();
            if (!method_exists($controller, $action)) {
                throw new \Exception("Action $action not found in $controllerClass");
            }

            $controller->$action();
        } catch (\Exception $exception) {
            // Handle exceptions, e.g., show a 404 page or error message
            var_dump($exception->getMessage());
        }

        return true;
    }
}
