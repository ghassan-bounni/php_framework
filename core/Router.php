<?php

namespace Core;

use Exception;

class Router
{
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }


    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            // return $this->callAction(...explode('@', $this->routes[$requestType][$uri]));
            return $this->callAction(...$this->routes[$requestType][$uri]);
        }

        throw new Exception('No route defined for this URI.');
    }

    protected function callAction($controller, $action)
    {
        // Add namespacing to the controller, and use double backslashes to
        // prevent the usage of a single backslash as an escape character:
        $namespacedController = "App\\Controllers\\{$controller}";

        $controller = new $namespacedController;
        if (method_exists($controller, $action)) {
            return $controller->$action();
        }


        throw new Exception(
            "{$controller} does not respond to the {$action} action."
        );
    }
}
