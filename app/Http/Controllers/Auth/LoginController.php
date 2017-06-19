<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Http\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

/**
 * @property  \App\Http\Validation\ validator
 * @property  \Slim\Views\Twig view
 * @property  \Slim\Router     router
 * @property  \App\Http\Validation\ validator
 */
class LoginController extends BaseController
{
    
    /**
     * Index Page return the Login form
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param                                          $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->view->render($response, 'auth/login.twig');
    }
    
    /**
     * Register new users
     *
     * @param \Psr\Http\Message\ServerRequestInterface                $request
     * @param \Psr\Http\Message\ResponseInterface|\Slim\Http\Response $response
     * @param                                                         $args
     *
     * @return \Psr\Http\Message\ResponseInterface|\Slim\Http\Response
     */
    public function login(ServerRequestInterface $request, Response $response, $args)
    {
        $validation = $this->validator->validate($request, [
            'email'    => \Respect\Validation\Validator::notEmpty(),
            'password' => \Respect\Validation\Validator::notEmpty(),
        ]);
        
        if ($validation->failed()) {
            
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
        
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );
        
        if ( ! $auth) {
            $this->flash->addMessage('error', 'Could not sign you in with those details.');
            
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
        
        return $response->withRedirect($this->router->pathFor('home'));
        
    }
    
    public function logout(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $this->auth->logout();
        
        return $response->withRedirect($this->router->pathFor('home'));
    }
    
    
}
