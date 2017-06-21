<?php

namespace App\Console;

use Interop\Container\ContainerInterface;
use Slim\App;
use Symfony\Component\Console\Application;

class Console extends Application
{
    
    /**
     * @var \Slim\App
     */
    protected $slim;
    
    /**
     * Console constructor.
     *
     * @param \Slim\App $slim
     *
     * @internal param \Interop\Container\ContainerInterface $c
     *
     * @internal param $output
     */
    public function __construct(App $slim)
    {
        parent::__construct();
        $this->slim = $slim;
    }
    
    
    public function boot(Kernel $kernel)
    {
        foreach ($kernel->getCommands() as $command) {
            $this->add(new $command($this->getSlim()->getContainer()));
        }
    }
    
    /**
     * @return \Slim\App
     */
    protected function getSlim()
    {
        return $this->slim;
    }
}
