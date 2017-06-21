<?php

namespace App\Console;

use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
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
     * @var string Command Name
     */
    protected $command;
    
    /**
     * @var string Command Name
     */
    protected $description;
    
    /**
     * @var string Command Name
     */
    protected $help;
    
    /**
     * Console constructor.
     *
     * @param \Interop\Container\ContainerInterface $c
     *
     * @internal param $output
     */
    public function __construct(ContainerInterface $c)
    {
        parent::__construct();
        $this->c = $c;
    }
    
    protected function configure()
    {
        $this->setName($this->command)
            ->setDescription($this->description)
            ->setHelp($this->help);
        
        $this->addArguments();
        $this->addOptions();
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        
        return $this->handle();
    }
    
    protected function handle()
    {
        throw new \Exception('Command must override handle method');
    }
    
    protected function argument($name)
    {
        return $this->input->getArgument($name);
    }
    
    protected function option($name)
    {
        return $this->input->getOption($name);
    }
    
    protected function line($value)
    {
        return $this->output->writeln($value);
    }
    
    protected function info($value)
    {
        return $this->output->writeln('<info>' . $value . '</info>');
    }
    
    protected function error($value)
    {
        return $this->output->writeln('<error>' . $value . '</error>');
    }
    
    protected function comment($value)
    {
        return $this->output->writeln('<comment>' . $value . '</comment>');
    }
    
    protected function question($value)
    {
        return $this->output->writeln('<question>' . $value . '</question>');
    }
    
    protected function fire($value)
    {
        $style = new OutputFormatterStyle('red', 'yellow', ['blink']);
        $this->output->getFormatter()->setStyle('fire', $style);
        
        return $this->output->writeln('<fire>' . $value . '</fire>');
    }
    
    
    public function addArguments()
    {
        foreach ($this->arguments() as $argument) {
            $this->addArgument(...$argument);
        }
        
        return $this;
    }
    
    public function addOptions()
    {
        foreach ($this->options() as $option) {
            $this->addOption(...$option);
        }
        
        return $this;
    }
    
    protected function arguments()
    {
    }
    
    protected function options()
    {
    }
    
    
}
