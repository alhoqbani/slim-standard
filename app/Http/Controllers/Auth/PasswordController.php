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
        dd(__METHOD__);
    }
    
    /**
     * Show change password form
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     */
    public function edit(ServerRequestInterface $request, ResponseInterface $response)
    {
        dd(__METHOD__);
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
        dd(__METHOD__);
    }
    
    
    
}
