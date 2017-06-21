<?php

namespace App\Console\Traits;

trait Generatable
{
    
    protected $stubDirectory = ROOT . 'app/Console/stubs/';
    
    /**
     * @param string $name         The stub name
     * @param array  $replacements The placeholders to be replaced
     *
     * @return string
     */
    protected function generateStub($name, $replacements)
    {
        return str_replace(
            array_keys($replacements),
            $replacements,
            file_get_contents($this->stubDirectory . $name . '.stub')
        );
    }
}