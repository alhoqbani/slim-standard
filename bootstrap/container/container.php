<?php

$container = $app->getContainer();

$container['csrf'] = function () {
    return new Slim\Csrf\Guard();
};

$container['validator'] = function () {
    return new App\Http\Validation\Validator();
};

require_once 'view.php';
//require_once 'pdo.php';
require_once 'eloquent.php';