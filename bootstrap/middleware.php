<?php

use App\Http\Middleware\CsrfViewMiddleware;


/** @var \Interop\Container\ContainerInterface $container */
$app->add(new CsrfViewMiddleware($container));
//$app->add($container->csrf);
