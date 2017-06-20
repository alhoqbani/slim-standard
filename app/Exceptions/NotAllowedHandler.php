<?php

namespace App\Exceptions;

use Slim\Handlers\NotAllowed;
use Slim\Views\Twig;

class NotAllowedHandler extends NotAllowed
{
    
    /**
     * @var \Slim\Views\Twig
     */
    private $view;
    
    /**
     * NotAllowedHandler constructor.
     *
     * @param \Slim\Views\Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->view = $twig;
    }
    
    protected function renderHtmlNotAllowedMessage($methods)
    {
        $allow = implode(', ', $methods);
        
        return $this->view->fetch('errors/405.twig', ['allow' => $allow]);
        
    }
}