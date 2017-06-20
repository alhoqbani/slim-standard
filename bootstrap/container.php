<?php

/** @var Pimple\Container $container */
$container = $app->getContainer();

$container['csrf'] = function () {
    return new Slim\Csrf\Guard();
};

$container['flash'] = function () {
    return new Slim\Flash\Messages();
};

$container['validator'] = function () {
    return new App\Http\Validation\Validator();
};

$container->register(new \App\Services\Mail\MailServiceProvider());
$container->register(new \App\Services\Auth\AuthServiceProvider());
$container->register(new \App\Services\View\TwigServiceProvider());
$container->register(new \App\Services\Database\EloquentServiceProvider());