<?php

namespace App\Core;

use App\Http\MiddleWare\Middleware;

class Router
{
    protected $routes = [];

    public function add(string $method, string $uri, array $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    public function get(string $uri, array $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, array $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete(string $uri, array $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch(string $uri, array $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put(string $uri, array $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function only(string $key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                if (is_array($route['controller'])) {
                    // If the controller is an array, assume it's a class-based controller
                    [$class, $method] = $route['controller'];
                    if (class_exists($class) && method_exists($class, $method)) {
                        $controllerInstance = new $class();

                        return $controllerInstance->$method();
                    }
                    throw new \Exception("No matching controller found for key '{$class}'.");
                }
            }
        }

        $this->abort();
    }

    public function previousUrl(): string
    {
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort(int $code = 404): never
    {
        http_response_code($code);

        require base_path("resources/views/{$code}.php");

        exit();
    }
}
