<?php

namespace App\Services\View;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Views\TwigExtension;

class TwigServiceProvider implements ServiceProviderInterface
{
    
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param \Pimple\Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        
        $pimple['view'] = function ($c) {
            $config = $c['settings']['twig'];
            $view = new \Slim\Views\Twig(
                $config['viewsPath'],
                [
                    'cache' => $config['enableCache'] ? $config['viewsCachePath'] : false,
                ]);
            
            $view->addExtension(new TwigExtension($c['router'], $c['request']->getUri()));
            $view->addExtension(new CsrfExtension($c['csrf']));
            
            
            $view->getEnvironment()->addGlobal('flash', $c->flash);
            $view->getEnvironment()->addGlobal('auth', [
                'check' => $c->auth->check(),
                'user'  => $c->auth->user(),
            ]);
            
            return $view;
        };
    }
}