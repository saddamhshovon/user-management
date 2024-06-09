<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;

$router->get('/', [AuthenticationController::class, 'view'])->middleware('guest');
$router->post('/login', [AuthenticationController::class, 'login'])->middleware('guest');
$router->post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth');
$router->get('/register', [RegistrationController::class, 'view'])->middleware('guest');
$router->post('/register', [RegistrationController::class, 'register'])->middleware('guest');

$router->get('/users', [UserController::class, 'index'])->middleware('auth');
$router->get('/users/create', [UserController::class, 'create'])->middleware('auth');
$router->post('/users', [UserController::class, 'store'])->middleware('auth');
$router->get('/users/{id}', [UserController::class, 'show'])->middleware('auth');
$router->get('/users/edit/{id}', [UserController::class, 'edit'])->middleware('auth');
$router->put('/users/{id}', [UserController::class, 'update'])->middleware('auth');
$router->delete('/users/{id}', [UserController::class, 'delete'])->middleware('auth');
