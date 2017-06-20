<?php

use App\Http\Middleware\CsrfViewMiddleware;
use App\Http\Middleware\OldInputMiddleware;
use App\Http\Middleware\ValidationMiddleware;


/** @var \Interop\Container\ContainerInterface $container */
$app->add(new CsrfViewMiddleware($container));
//$app->add($container->csrf);

$app->add(new ValidationMiddleware($container));
$app->add(new OldInputMiddleware($container));


// Set the base path
$app->add(function ($req, $res, $next) {
    $this->router->setBasePath($req->getUri()->getBaseUrl());
    
    return $next($req, $res);
});
