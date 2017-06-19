<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


/**
 * @property  \Slim\Csrf\Guard csrf
 */
class CsrfViewMiddleware extends BaseMiddleware
{
    
    /**
     * Attach csrf token to Twig views
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, callable $next)
    {
        
        $this->view->getEnvironment()->addGlobal('csrf', [
            'field' => "
            <input type='hidden' name='{$this->csrf->getTokenNameKey()}' value='{$this->csrf->getTokenName()}'>
            <input type='hidden' name='{$this->csrf->getTokenValueKey()}' value='{$this->csrf->getTokenValue()}'>
            ",
        ]);
        
        $csrf = [
            'name'  => ['key' => $this->csrf->getTokenNameKey(), 'value' => $this->csrf->getTokenName()],
            'value' => ['key' => $this->csrf->getTokenValueKey(), 'value' => $this->csrf->getTokenValue()],
        ];
        $csrfObject = json_encode($csrf);
        
        /** @var Response $response */
        $response = $next($request, $response);
        $response = $response->withHeader('X-CSRF-Token', $csrfObject);
        
        return $response;
    }
}