<?php

use App\Core\Response;
use App\Core\Session;

function dd(mixed $value): never
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    exit();
}

function urlIs(string $value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort(int $code = 404, array $attributes = []): never
{
    http_response_code($code);
    extract($attributes);
    require base_path("resources/views/errors/{$code}.view.php");

    exit();
}

function authorize(mixed $condition, int $status = Response::FORBIDDEN): bool
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path(string $path): string
{
    return BASE_PATH.$path;
}

function view(string $path, array $attributes = [])
{
    extract($attributes);

    require base_path('resources/views/'.$path.'.view.php');
}

function redirect(string $path): never
{
    header("location: {$path}");
    exit();
}

function old(string $key, string $default = ''): mixed
{
    return Session::get('old')[$key] ?? $default;
}
