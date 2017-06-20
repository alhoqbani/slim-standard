<?php

namespace App\Services\Mail;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Swift_Mailer;
use Swift_SmtpTransport;
use App\Services\Mail\Mailer\Mailer;

class MailServiceProvider implements ServiceProviderInterface
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
        $pimple['mail'] = function ($container) {
            $config = $container['settings']['mail'];
            // Create the Transport
            $transport = (new Swift_SmtpTransport($config['host'], $config['port']))
                ->setUsername($config['username'])
                ->setPassword($config['password']);
            
            $mailer = new Swift_Mailer($transport);
            
            return (new Mailer($mailer, $container['view']))
                ->alwaysFrom($config['from']['address'], $config['from']['name']);
        };
        
    }
}