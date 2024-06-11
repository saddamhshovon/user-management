<?php

namespace App\Http\Middleware;

class Middleware
{
    public const MIDDLEWARES = [
        'guest' => Guest::class,
        'auth' => Authenticated::class,
    ];

    public static function resolve(?string $key): void
    {
        if (! $key) {
            return;
        }

        $middleware = static::MIDDLEWARES[$key] ?? false;

        if (! $middleware) {
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }

        (new $middleware)->handle();
    }
}
