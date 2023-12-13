<?php

class Routeur
{
    private $page;
    private $routes = [];

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function addRoute($pageName, $callback)
    {
        $this->routes[$pageName] = $callback;
    }

    public function route()
    {
        if (array_key_exists($this->page, $this->routes)) {
            call_user_func($this->routes[$this->page]);
        } else {
            echo 'Page not found : 404';
        }
    }
}

?>