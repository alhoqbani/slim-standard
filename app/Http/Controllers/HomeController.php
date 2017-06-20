<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Validation\Validator;
use App\Services\Mail\Welcome;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @property  \Slim\Views\Twig                      view
 * @property  \Slim\Router                          router
 * @property  \App\Http\Validation\                 validator
 * @property-read  \App\Services\Mail\Mailer\Mailer mail
 */
class HomeController extends BaseController
{
    
    /**
     * Index Page
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param                                          $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $user = User::first();
        
//        $this->mail->send('emails/welcome.twig', ['user' => $user], function ($message) use ($user) {
//            $message->to($user->email, $user->name)
//                ->subject('Welcome to slim-standard');
////        });
//
//        $this->mail->to($user->email, $user->name)->send(new Welcome($user));
//
//        $this->mail->send('emails/welcome.twig', ['user' => $user], function ($message) use ($user) {
//            $message->to($user->email)
//                ->attach(ROOT . 'composer.json')
//                ->subject('Composer File');
//        });
    
        return $this->view->render($response, 'home.twig', compact('users'));
    }
}
