<?php

$container = $app->getContainer();

$container['csrf'] = function () {
    return new Slim\Csrf\Guard();
};

$container['flash'] = function () {
    return new Slim\Flash\Messages();
};

$container['auth'] = function () {
    return new App\Services\Auth\Auth();
};

$container['validator'] = function () {
    return new App\Http\Validation\Validator();
};

$container['mail'] = function ($container) {
    $config = $container['settings']['mail'];
    // Create the Transport
    $transport = (new Swift_SmtpTransport($config['host'], $config['port']))
        ->setUsername($config['username'])
        ->setPassword($config['password']);
    
    $mailer = new Swift_Mailer($transport);
    
    return (new App\Services\Mail\Mailer\Mailer($mailer, $container['view']))
        ->alwaysFrom($config['from']['address'], $config['from']['name']);
};

require_once 'view.php';
//require_once 'pdo.php';
require_once 'eloquent.php';