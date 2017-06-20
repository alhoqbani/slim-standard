<?php

namespace App\Services\Database;

use PDO;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PdoServiceProvider implements ServiceProviderInterface
{
    
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['db'] = function ($c) {
            $config = $c['settings']['database'];
            $dsn = $config['driver'] . ':dbname=' . $config['dbname'] . ';host=' . $config['host'];
            
            $pdo = new PDO($dsn, $config['username'], $config['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            
            return $pdo;
        };
    }
}