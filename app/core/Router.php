<?php

namespace App\Core;

class Router {
    protected $routes = [];

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function dispatch($uri) {
        foreach ($this->routes as $route => $handler) {
            // Replace URL parameters with regex pattern
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route);
            $pattern = str_replace('/', '\/', $pattern);

            if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
                // Remove full match and keep named captures
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Extract controller, method
                list($controller, $method) = explode('@', $handler);

                return compact('controller', 'method', 'params');
            }
        }

        return false; // Route not found
    }
}
