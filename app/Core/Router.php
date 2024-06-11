<?php

namespace App\Core;

use App\Http\Middleware\Middleware;

class Router
{
    protected array $routes = [];

    private function add(string $httpMethod, string $uri, array $controller): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'httpMethod' => $httpMethod,
            'middleware' => null,
        ];

        return $this;
    }

    public function get(string $uri, array $controller): Router
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post(string $uri, array $controller): Router
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete(string $uri, array $controller): Router
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch(string $uri, array $controller): Router
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put(string $uri, array $controller): Router
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function middleware(string $key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /**
     * This method is called after the project is bootstrapped
     * and ready to serve responses according to requested routes.
     */
    public function route(string $uri, string $httpMethod): mixed
    {
        foreach ($this->routes as $route) {
            /**
             * Replaces registered route pattern with string '/(\w+)' to generate the pattern.
             * Example: 'users/{id}' -> 'users/(\w+)'
             */
            $pattern = preg_replace('/\/{\w+}/', '/(\w+)', $route['uri']);

            /**
             * Replaces '/' with '\/'
             */
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^'.$pattern.'$/';

            /**
             * Checks if the pattern matches with the parsed uri & if the methods matches.
             */
            if (preg_match($pattern, $uri, $matches) && $route['httpMethod'] === strtoupper($httpMethod)) {
                /**
                 * Shifts the first index as it contains the parsed uri.
                 */
                array_shift($matches);

                Middleware::resolve($route['middleware']);
                [$class, $classMethod] = $route['controller'];

                if (class_exists($class) && method_exists($class, $classMethod)) {
                    $controllerInstance = new $class();

                    /**
                     * Creates an instance of the registered class &
                     * calls the registered method while passing the params.
                     */
                    return call_user_func_array([$controllerInstance, $classMethod], $matches);
                }
                throw new \Exception("No matching controller found for key '{$class}'.");
            }
        }

        abort(Response::NOT_FOUND);
    }

    public function previousUrl(): string
    {
        return $_SERVER['HTTP_REFERER'];
    }
}
