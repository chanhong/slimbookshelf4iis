<?php

// Do not modify this file. Instead, copy it to settings.php and modify that one.

return [
    'settings' => [
        'displayErrorDetails' => true,         
        'db' => [
            // Illuminate/database configuration
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'bookshelf',
            'username'  => 'root',
            'password'  => 'mysql8510',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'view' => [
            'template_path' => DOCROOT .'/app/templates/twig',
            'twig' => [
                'cache' => CACHEROOT .'/cache/twig',
                'debug' => true,
            ],
        ],
        'phpview' => [
            'template_path' => DOCROOT .'/app/templates/phpview',
        ],
        'tpl' => [
            'selected_layout' => constant("LAYOUT"),
            'pubdir' => constant("PUBDIR"),
        ],
    ],
];
