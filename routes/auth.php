<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->get('/register', RegistrationController::class . ':index')->setName('auth.register');
$app->post('/register', RegistrationController::class . ':register');

$app->get('/login', LoginController::class . ':index')->setName('auth.login');
$app->post('/login', LoginController::class . ':login');