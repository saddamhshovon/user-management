<?php

use App\Core\App;
use App\Core\Container;
use App\Core\Database;

$container = new Container();

$container->bind('App\Core\Database', function () {
    $databaseConfig = require base_path('config/database.php');

    return new Database($databaseConfig['mariadb']);
});

App::setContainer($container);
