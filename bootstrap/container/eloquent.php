<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$config = $container['settings']['database'];

$capsule->addConnection([
    'driver'    => $config['driver'],
    'host'      => $config['host'],
    'database'  => $config['dbname'],
    'username'  => $config['username'],
    'password'  => $config['password'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();


$container['db'] = function ($c) use ($capsule) {
    
    return $capsule;
};