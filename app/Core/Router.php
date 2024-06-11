<?php

namespace App\Core;

use App\Http\Middleware\Middleware;

class Router
{
    protected $routes = [];

    private function add(string $httpMethod, string $uri, array $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'httpMethod' => $httpMethod,
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

    public function middleware(string $key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route(string $uri, string $httpMethod)
    {
        foreach ($this->routes as $route) {
            // Prepare regular expression pattern to match dynamic segments
            $pattern = preg_replace('/\/{\w+}/', '/(\w+)', $route['uri']);
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^'.$pattern.'$/';

            // Check if URI matches the pattern and HTTP method matches
            if (preg_match($pattern, $uri, $matches) && $route['httpMethod'] === strtoupper($httpMethod)) {
                array_shift($matches); // Remove full match

                Middleware::resolve($route['middleware']);
                [$class, $classMethod] = $route['controller'];

                if (class_exists($class) && method_exists($class, $classMethod)) {
                    $controllerInstance = new $class();

                    // Call controller method with dynamic parameters
                    return call_user_func_array([$controllerInstance, $classMethod], $matches);
                }
                throw new \Exception("No matching controller found for key '{$class}'.");
            }
        }

        abort(404);
    }

    public function previousUrl(): string
    {
        return $_SERVER['HTTP_REFERER'];
    }
}
