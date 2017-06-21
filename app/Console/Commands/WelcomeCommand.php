<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Symfony\Component\Console\Input\InputArgument;

class WelcomeCommand extends BaseCommand
{
    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;
    
    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;
    
    
    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $c;
    
    /**
     * The command name.
     *
     * @var string
     */
    protected $command = 'app:welcome';
    
    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Welcome command.';
    
    /**
     * The command help.
     *
     * @var string
     */
    protected $help = 'You don\'t need help with this';
    
    /**
     * Execute the command
     *
     * @return void
     */
    protected function handle()
    {
        $this->fire('Welcome to your new app');
    }
    
    /**
     * @return array
     */
    protected function arguments()
    {
        return [
//            [$name, $mode = InputArgument::REQUIRED, $description = '', $default = null],
        ];
    }
    
    /**
     * @return array
     */
    protected function options()
    {
        return [
//            [name, $shortcut = null, $mode = null, $description = '', $default = null],
        ];
    }
}