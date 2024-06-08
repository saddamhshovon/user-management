<?php

use App\Http\Controllers\TestController;

$router->get('/', [TestController::class, 'index']);
