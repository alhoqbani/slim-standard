<?php

use App\Http\Middleware\CsrfViewMiddleware;
use App\Http\Middleware\OldInputMiddleware;
use App\Http\Middleware\ValidationMiddleware;



/** @var \Interop\Container\ContainerInterface $container */
$app->add(new CsrfViewMiddleware($container));
//$app->add($container->csrf);

$app->add(new ValidationMiddleware($container));
$app->add(new OldInputMiddleware($container));
