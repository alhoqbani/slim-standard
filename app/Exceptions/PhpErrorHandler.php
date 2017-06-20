<?php

namespace App\Exceptions;

use Slim\Handlers\PhpError;
use Slim\Views\Twig;

class PhpErrorHandler extends PhpError
{
    
    /**
     * @var \Slim\Views\Twig
     */
    private $view;
    
    /**
     * PhpErrorHandler constructor.
     *
     * @param \Slim\Views\Twig $twig
     * @param                  $displayErrorDetails
     */
    public function __construct(Twig $twig, bool $displayErrorDetails)
    {
        parent::__construct($displayErrorDetails);
        $this->view = $twig;
    }
    
    protected function renderHtmlError(\Throwable $error)
    {
        if ($this->displayErrorDetails) {
            return parent::renderHtmlError($error);
        }
        
        return $this->view->fetch('errors/500.twig');
        
    }
    
    
}