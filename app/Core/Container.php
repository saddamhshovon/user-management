<?php

namespace App\Core;

use Exception;

class Container
{
    protected array $bindings = [];

    /**
     * Binds classes with their resolvers.
     */
    public function bind(string $key, mixed $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * Resolves container binding.
     *
     * @throws Exception
     */
    public function resolve(string $key): mixed
    {
        if (! array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
