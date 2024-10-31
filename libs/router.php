<?php

class Router {
    private $routes = [];

    public function addRoute($route, $method, $controller, $action) {
        $this->routes[] = [
            'route' => $route,
            'method' => $method,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function route($resource, $method) {
        foreach ($this->routes as $route) {
            if ($this->match($route['route'], $resource) && $route['method'] == $method) {
                $controller = new $route['controller']();
                $action = $route['action'];
                $params = $this->extractParams($route['route'], $resource);
                $controller->$action((object)['params' => (object)$params]);
                return;
            }
        }
        echo "404 Page Not Found";
    }

    private function match($route, $resource) {
        $routeParts = explode('/', $route);
        $resourceParts = explode('/', $resource);
        if (count($routeParts) != count($resourceParts)) {
            return false;
        }
        for ($i = 0; $i < count($routeParts); $i++) {
            if ($routeParts[$i][0] != ':' && $routeParts[$i] != $resourceParts[$i]) {
                return false;
            }
        }
        return true;
    }

    private function extractParams($route, $resource) {
        $routeParts = explode('/', $route);
        $resourceParts = explode('/', $resource);
        $params = [];
        for ($i = 0; $i < count($routeParts); $i++) {
            if ($routeParts[$i][0] == ':') {
                $params[substr($routeParts[$i], 1)] = $resourceParts[$i];
            }
        }
        return $params;
    }
}