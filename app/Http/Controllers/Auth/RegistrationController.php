<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Http\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @property  \Slim\Views\Twig view
 * @property  \Slim\Router     router
 * @property  \App\Http\Validation\ validator
 */
class RegistrationController extends BaseController
{
    
    /**
     * Index Page return the registration form
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param                                          $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->view->render($response, 'auth/register.twig');
    }
    
    /**
     * Register new users
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param                                          $args
     */
    public function register(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        User::create([
            'name'     => $request->getParam('name'),
            'email'    => $request->getParam('email'),
            'password' => password_hash($request->getParam('name'), PASSWORD_DEFAULT),
        ]);
    }
    
}
