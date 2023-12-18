<?php

namespace App;

use App\Controller\PostController;

final class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->addRoute('cgv', 'GeneralConditionsController');
    }

    public function addRoute(string $name, string $controller): void
    {
        $this->routes[$name] = $controller;
    }

    public function matchRoute(string $name, ?string $action): bool
    {
        try {
            if (!$action) {
                throw new \Exception("Il y a besoin d'une action controller !");
            }

            $controller = null;

            if (key_exists($name, $this->routes)) {
                $controller = $this->routes[$name];
            }

            if (!file_exists(__DIR__ . "/Controller/{$controller}.php")) {
                throw new \Exception(sprintf("Le fichier %s n'existe pas ", "{$controller}.php"));
            }

            $controller = new PostController();

            if (!method_exists($controller, $action)) {
                throw new \Exception(sprintf("L'action %s n'est pas dans %s!", $action, $controller));
            }

            $controller->$action();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }

        return true;
    }
}
