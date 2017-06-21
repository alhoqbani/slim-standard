<?php

namespace App\Console\Commands\Generators;

use App\Console\BaseCommand;
use App\Console\Traits\Generatable;
use Symfony\Component\Console\Input\InputArgument;

class ControllerGeneratorCommand extends BaseCommand
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
    protected $command = 'make:controller';
    
    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Create new controller.';
    
    /**
     * The command help.
     *
     * @var string
     */
    protected $help = 'Example: Users\\UsersController';
    
    /**
     * Execute the command
     *
     * @return mixed
     */
    protected function handle()
    {
        $controllerBase = ROOT . 'app/Http/Controllers';
        $path = $controllerBase . '/';
        $namespace = 'App\\Controllers';
        
        
        $fileParts = explode('\\', $this->argument('name'));
        
        $fileName = array_pop($fileParts);
        $cleanPath = implode('/', $fileParts);
        
        if (count($fileParts) >= 1) {
            $path = $path . $cleanPath;
            
            $namespace = $namespace . '\\' . str_replace('/', '\\', $cleanPath);
            
            if ( ! is_dir($path)) {
                mkdir($path, 0755, true);
            }
        }
        
        $target = $path . '/' . $fileName . '.php';
        
        if (file_exists($target)) {
            return $this->error('Controller already exists!');
        }
        
        $stub = $this->generateStub('controller', [
            'StubClassName'    => $fileName,
            'StubNamespace' => $namespace,
        ]);
        
        file_put_contents($target, $stub);
        
        $this->info('Controller generated!');
        
    }
    
    /**
     * @return array
     */
    protected function arguments()
    {
        return [
            ['name', $mode = InputArgument::REQUIRED, $description = 'The name of the new controller'],
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