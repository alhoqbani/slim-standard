<?php

namespace App\Exceptions;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\Error;
use Slim\Views\Twig;

class ErrorHandler extends Error
{
    
    /**
     * @var \Slim\Views\Twig
     */
    private $view;
    
    /**
     * NotFoundHandler constructor.
     *
     * @param \Slim\Views\Twig $twig
     * @param                  $displayErrorDetails
     */
    public function __construct(Twig $twig, bool $displayErrorDetails)
    {
        parent::__construct($displayErrorDetails);
        $this->view = $twig;
    }
    
    protected function renderHtmlErrorMessage(\Exception $exception)
    {
        if ($this->displayErrorDetails) {
            return parent::renderHtmlErrorMessage($exception);
        };
        
        return $this->view->fetch('errors/500.twig');
    }
    
    
}