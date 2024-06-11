<?php

namespace App\Core;

class App
{
    protected static Container $container;

    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    private static function container(): Container
    {
        return static::$container;
    }

    /**
     * Binds classes with their resolvers to the container.
     */
    public static function bind($key, $resolver): void
    {
        static::container()->bind($key, $resolver);
    }

    /**
     * Resolves binding from container.
     */
    public static function resolve(string $key): mixed
    {
        return static::container()->resolve($key);
    }
}
