<?php

namespace App\Http\Validation;


use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    
    protected $errors = [];
    
    public function validate(ServerRequestInterface $request, array $rules)
    {
        /** @var \Respect\Validation\Validator $rule */
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName($field)->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }
        $_SESSION['errors'] = $this->errors;
        
        
        return $this;
    }
    
    public function failed()
    {
        return ! empty($this->errors);
    }
    
}