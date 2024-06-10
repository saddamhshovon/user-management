<?php

use App\Core\Exceptions\ValidationException;
use App\Core\Router;
use App\Core\Session;

const BASE_PATH = __DIR__.'/../';

session_start();

require BASE_PATH.'vendor/autoload.php';
require BASE_PATH.'helpers/helpers.php';
require BASE_PATH.'bootstrap/app.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$router = new Router();
require BASE_PATH.'routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$httpMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $httpMethod);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();
