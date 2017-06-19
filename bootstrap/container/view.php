<?php

$container['view'] = function ($c) {
    $config = $c['settings']['twig'];
    $view = new \Slim\Views\Twig(
        $config['viewsPath'],
        [
            'cache' => $config['enableCache'] ? $config['viewsCachePath'] : false,
        ]);
    
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
    $view->addExtension(new \App\View\CsrfExtension($c['csrf']));
    
    
    $view->getEnvironment()->addGlobal('flash', $c->flash);
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user'  => $c->auth->user(),
    ]);
    
    
    return $view;
};
