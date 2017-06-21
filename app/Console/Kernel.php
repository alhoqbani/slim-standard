<?php

namespace App\Console;

use App\Console\Commands\Generators\ConsoleGeneratorCommand;
use App\Console\Commands\Generators\ControllerGeneratorCommand;
use App\Console\Commands\WelcomeCommand;

class Kernel
{
    
    protected $commands = [
        WelcomeCommand::class
    ];
    
    protected $defaultCommands = [
        ConsoleGeneratorCommand::class,
        ControllerGeneratorCommand::class,
    ];
    
    public function getCommands()
    {
        return array_merge(
            $this->commands,
            $this->defaultCommands
        );
    }
}