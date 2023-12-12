<?php

class Rooter
{
    private $routes = [];

    public function add($uri, $handler)
    {
        $this->routes[$uri] = $handler;
    }

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $uri => $handler) {
            // Assurez-vous que $uri commence par un / pour correspondre correctement.
            if ($uri[0] !== '/') {
                $uri = '/' . $uri;
            }

            // Comparaison en utilisant strpos pour gérer le cas où l'URI demandée est un sous-chemin.
            if (strpos($requestUri, $uri) === 0 && is_callable($handler)) {
                call_user_func($handler);
                return;
            }
        }

        // Aucune route trouvée, renvoyer une erreur 404.
        http_response_code(404);
        echo "404 Not Found";
    }
}

