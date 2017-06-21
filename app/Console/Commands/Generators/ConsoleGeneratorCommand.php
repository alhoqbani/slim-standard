<?php

namespace App\Console\Commands\Generators;

use App\Console\BaseCommand;
use App\Console\Traits\Generatable;
use Symfony\Component\Console\Input\InputArgument;

class ConsoleGeneratorCommand extends BaseCommand
{
    
    use Generatable;
    
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
    protected $command = 'make:command';
    
    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Create new console command.';
    
    /**
     * The command help.
     *
     * @var string
     */
    protected $help = '';
    
    /**
     * Execute the command
     *
     * @return mixed
     */
    protected function handle()
    {
        $stub = $this->generateStub('command', [
            'StubCommandName' => $this->argument('name'),
        ]);
        
        $target = ROOT . 'app/Console/Commands/' . $this->argument('name') . '.php';
        
        if (file_exists($target)) {
            return $this->error('Command already exists');
        };
        
        file_put_contents($target, $stub);
        
        $this->info('The new command: <fg=magenta>' . $this->argument('name') . '</> was created');
    }
    
    /**
     * @return array
     */
    protected function arguments()
    {
        return [
            ['name', $mode = InputArgument::REQUIRED, $description = 'The name of the new command'],
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