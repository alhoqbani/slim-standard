<?php

namespace App\Exceptions;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ErrorHandlerServiceProvider implements ServiceProviderInterface
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
        $pimple['notFoundHandler'] = function ($c) {
            return new NotFoundHandler($c->view);
        };
        
        $pimple['notAllowedHandler'] = function ($c) {
            return new notAllowedHandler($c->view);
        };
        
        $pimple['phpErrorHandler'] = function ($c) {
            return new PhpErrorHandler($c->view, $c['settings']['displayErrorDetails']);
        };
        
        $pimple['errorHandler'] = function ($c) {
            return new ErrorHandler($c->view, $c['settings']['displayErrorDetails']);
        };
        
    }
}