<?php

namespace App\Core;

use Exception;

class Container
{
    protected $bindings = [];

    public function bind($key, $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * @throws Exception
     */
    public function resolve($key): mixed
    {
        if (! array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
