<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Http\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator as v;

/**
 * @property-read  \Slim\Views\Twig view
 * @property-read  \Slim\Router     router
 * @property-read  \App\Http\Validation\ validator
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
        $validation = $this->validator->validate($request, [
            'email'    => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name'     => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);
        
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }
        
        User::create([
            'name'     => $request->getParam('name'),
            'email'    => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);
        
        $this->flash->addMessage('info', 'You have been signed up!');
        
        return $response->withRedirect($this->router->pathFor('home'));
        
    }
    
}
