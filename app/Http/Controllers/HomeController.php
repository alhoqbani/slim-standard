<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Validation\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @property  \Slim\Views\Twig view
 * @property  \Slim\Router     router
 * @property  \App\Http\Validation\ validator
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
        return $this->view->render($response, 'home.twig', compact('users'));
    }
}
