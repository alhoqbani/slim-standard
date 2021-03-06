<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Http\Validation\Validator;
use App\Services\Mail\ResetPassword;
use App\Services\Mail\Welcome;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Validator as v;

/**
 * @property-read  \Slim\Views\Twig            view
 * @property-read  \Slim\Router                router
 * @property-read  \App\Http\Validation\ validator
 * @property  \App\Services\Mail\Mailer\Mailer mail
 */
class PasswordController extends BaseController
{
    
    /**
     * Show reset password form
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(ServerRequestInterface $request, ResponseInterface $response)
    {
        if ($request->getMethod() === "GET") {
            return $this->view->render($response, 'auth/password/request.twig');
        }
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email(),
        ]);
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('password.request'));
        }
        
        if ($user = User::findByEmail($request->getParam('email'))) {
            $this->mail->to($user->email, $user->name)
                ->send(new ResetPassword($user,
                    $this->auth->passwordToken($user)));
        }
        $this->flash->addMessage('info', 'If we have your email in our records, we will send an email');
        
        return $response->withRedirect($this->router->pathFor('auth.login'));
        
    }
    
    /**
     * reset password from link received by email
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param                                          $args
     */
    public function reset(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $token = $args['token'];
        if ( ! $email = $this->auth->validateToken($token)) {
            return $response->withStatus(401);
        }
        
        if ($request->getMethod() === "GET") {
            return $this->view->render(
                $response,
                'auth/password/reset.twig',
                ['email' => $email, 'token' => $token]
            );
        }
        
        $validation = $this->validator->validate($request, [
            'password' => v::noWhitespace()->notEmpty(),
        ]);
        
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('password.reset', ['token' => $token]));
        }
        
        if ($user = User::findByEmail($email)) {
            $this->auth->resetPassword($user, $request->getParam('password'));
            $this->flash->addMessage('success', 'You Password was changed');
            
            return $response->withRedirect($this->router->pathFor('auth.login'));
            
        };
        
        
    }
    
    /**
     * Show change password form
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function edit(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->view->render($response, 'auth/password/edit.twig');
    }
    
    /**
     * Update password
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param                                          $args
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $validation = $this->validator->validate($request, [
            'current_password' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'new_password'     => v::noWhitespace()->notEmpty(),
        ]);
        
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('password.change'));
        }
        
        $this->auth->user()->Update([
            'password' => password_hash($request->getParam('new_password'), PASSWORD_DEFAULT),
        
        ]);
        
        $this->flash->addMessage('info', 'Your password was changed.');
        
        return $response->withRedirect($this->router->pathFor('home'));
        
    }
    
    
}
