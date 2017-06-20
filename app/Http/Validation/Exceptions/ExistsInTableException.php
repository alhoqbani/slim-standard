<?php

namespace App\Http\Validation\Exceptions;

use \Respect\Validation\Exceptions\ValidationException;

class ExistsInTableException extends ValidationException
{
    
    public static $defaultTemplates = [
        self::MODE_DEFAULT  => [
            self::STANDARD => 'This already exists.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'This does not exist',
        ],
    ];
}
