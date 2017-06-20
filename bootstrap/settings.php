<?php

return [
    'displayErrorDetails' => getenv('APP_DEBUG') === 'true' ? true : false,
    
    'app' => [
        'name' => getenv('APP_NAME'),
        'url'  => getenv('APP_URL'),
        'env'  => getenv('APP_ENV'),
    ],
    
    'twig' => [
        'viewsPath'      => ROOT . 'resources/views',
        'viewsCachePath' => ROOT . 'storage/cache/views',
        'enableCache'    => false,
    ],
    
    'database' => [
        'driver'   => getenv('DB_CONNECTION'),
        'host'     => getenv('DB_HOST'),
        'port'     => getenv('DB_PORT'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname'   => getenv('DB_DATABASE'),
    ],
    
    'mail' => [
        'host'     => getenv('MAIL_HOST'),
        'port'     => getenv('MAIL_PORT'),
        'from'     => [
            'address' => getenv('MAIL_FROM_ADDRESS'),
            'name'    => getenv('MAIL_FROM_NAME'),
        ],
        'username' => getenv('MAIL_USERNAME'),
        'password' => getenv('MAIL_PASSWORD'),
    ],

];