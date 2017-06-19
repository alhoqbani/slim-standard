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
class PasswordController extends BaseController
{
    
    /**
     * Show reset password form
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     */
    public function request(ServerRequestInterface $request, ResponseInterface $response)
    {
        dd(__METHOD__);
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
            'new_password' => v::noWhitespace()->notEmpty(),
        ]);
    
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('password.change'));
        }
    
        $this->auth->user()->Update(['password' => $request->getParam('new_password')]);
    
        $this->flash->addMessage('info', 'Your password was changed.');
        return $response->withRedirect($this->router->pathFor('home'));
    
    }
    
    
    
}
