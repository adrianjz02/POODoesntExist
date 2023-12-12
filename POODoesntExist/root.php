<?php

class Router {
    private $routes = [];

    public function add($uri, $handler) {
        $this->routes[$uri] = $handler;
    }

    public function run() {
        $requestUri = trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $uri => $handler) {
            if ($uri === $requestUri && is_callable($handler)) {
                call_user_func($handler);
                return;
            }
        }

        // Aucune route trouvée, renvoyer une erreur 404.
        http_response_code(404);
        echo "404 Not Found";
    }
}
