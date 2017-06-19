<?php

$container = $app->getContainer();

$container['csrf'] = function () {
    return new Slim\Csrf\Guard();
};

require_once 'view.php';
//require_once 'pdo.php';
require_once 'eloquent.php';