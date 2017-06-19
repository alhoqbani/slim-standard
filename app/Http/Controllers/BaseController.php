<?php

namespace App\Http\Controllers;

use Interop\Container\ContainerInterface;

/**
 * @property  \Slim\Views\Twig        view
 * @property  \Slim\Router            router
 * @property  \App\Http\Validation\ validator
 * @property  \PDO                    db
 * @property  \App\Services\Auth\Auth auth
 */
class BaseController
{
    
    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $c;
    
    public function __construct(ContainerInterface $container)
    {
        $this->c = $container;
    }
    
    public function __get($name)
    {
        if ($this->c->has("{$name}")) {
            return $this->c->{$name};
        }
    }
}
