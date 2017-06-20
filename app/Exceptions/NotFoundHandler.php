<?php

namespace App\Exceptions;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\NotFound;
use Slim\Views\Twig;

class NotFoundHandler extends NotFound
{
    
    /**
     * @var \Slim\Views\Twig
     */
    private $view;
    
    /**
     * NotFoundHandler constructor.
     *
     * @param \Slim\Views\Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->view = $twig;
    }
    
    protected function renderHtmlNotFoundOutput(ServerRequestInterface $request)
    {
        return $this->view->fetch('errors/404.twig');
    }
    
}