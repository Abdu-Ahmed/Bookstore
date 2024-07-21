<?php

namespace App\Core\API;

class APIRouter {
    protected $routes = [];

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route => $handler) {
            list($routeMethod, $routePattern) = explode(' ', $route, 2);
            if (strcasecmp($method, $routeMethod) !== 0) {
                continue;
            }

            // Replace URL parameters with regex pattern
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $routePattern);
            $pattern = str_replace('/', '\/', $pattern);

            if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
                // Remove full match and keep named captures
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Extract controller, method
                list($controller, $method) = explode('@', $handler);

                // Adjust controller namespace
                $controller = 'App\\Controllers\\API\\' . $controller;

                return compact('controller', 'method', 'params');
            }
        }

        return false; // Route not found
    }
}
