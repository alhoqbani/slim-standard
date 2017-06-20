<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\Mail\Welcome;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator as v;

/**
 * @property-read  \Slim\Views\Twig                    view
 * @property-read  \Slim\Router                        router
 * @property-read  \App\Http\Validation\ validator
 * @property-read  \App\Services\Mail\Mailer\Mailer    mail
 * @property-read       \App\Http\Validation\Validator validator
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
            'email'    => v::noWhitespace()->notEmpty()->email()->existsInTable($this->db->table('users'), 'email'),
            'name'     => v::notEmpty()->alpha(),
            'username' => v::noWhitespace()->notEmpty()->alpha()->existsInTable($this->db->table('users'), 'username'),
            'password' => v::noWhitespace()->notEmpty(),
        ]);
        
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }
        
        $user = User::create([
            'name'     => $request->getParam('name'),
            'username' => $request->getParam('username'),
            'email'    => $request->getParam('email'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);
        
        $this->flash->addMessage('info', 'You have been signed up!');
        $this->auth->signIn($user);
        $this->mail->to($user->email, $user->name)->send(new Welcome($user));
        
        return $response->withRedirect($this->router->pathFor('home'));
        
    }
    
}
