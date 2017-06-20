<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->group('', function () {
    
    $this->get('/register', RegistrationController::class . ':index')->setName('auth.register');
    $this->post('/register', RegistrationController::class . ':register');
    
    $this->get('/password/reset', PasswordController::class . ':request')->setName('password.request');
    $this->post('/password/reset', PasswordController::class . ':request');
    $this->get('/password/reset/{token}', PasswordController::class . ':reset')->setName('password.reset');
    
    $this->get('/login', LoginController::class . ':index')->setName('auth.login');
    $this->post('/login', LoginController::class . ':login');
})->add(new GuestMiddleware($container));


$app->group('', function () {
    $this->get('/password/change', PasswordController::class . ':edit')->setName('password.change');
    $this->post('/password/change', PasswordController::class . ':update');
    
    $this->get('/logout', LoginController::class . ':logout')->setName('auth.logout');
    $this->post('/logout', LoginController::class . ':logout');
})->add(new AuthMiddleware($container));