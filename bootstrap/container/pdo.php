<?php

$container['db'] = function ($c) {
    $config = $c['settings']['database'];
    $dsn = $config['driver'] . ':dbname=' . $config['dbname'] . ';host=' . $config['host'];
    
    $pdo = new \PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
    return $pdo;
};