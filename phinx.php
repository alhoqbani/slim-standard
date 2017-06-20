<?php

require_once './bootstrap/app.php';

$config = $container['settings']['database'];

return [
    'paths'                => [
        'migrations' => 'database/migrations',
        'seeds'      => 'database/seeds',
    ],
    'migration_base_class' => 'BaseMigration',
    'templates'            => [
        'class' => 'TemplateGenerator',
    ],
    'aliases'              => [
        'create' => 'CreateTableTemplateGenerator',
    ],
    
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database'        => 'development',
        'development'             => [
            'name'       => $config['dbname'],
            'connection' => $container->db,
        ],
        'production'              => [
            'adapter'   => $config['driver'],
            'host'      => $config['host'],
            'name'      => $config['dbname'],
            'user'      => $config['username'],
            'pass'      => $config['password'],
            'port'      => $config['port'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ],
];