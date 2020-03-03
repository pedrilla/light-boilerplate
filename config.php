<?php

/**
 * If will be available class with name \App\Bootstrap and it will be extends from \Light\BootstrapAbstract
 * it will be initialized and called each function
 */

return [

    'light' => [

        // Namespace for the modules
        // If not exists will be used app folder path - loader.namespace \\Controller, \\View and etc.
        'modules'   => '\\App\\Module',

        // Display exceptions
        // Not required - just will be used as false
        'exception' => true,

        // Cookie namespace. String
        'cookie' => null,

        // PHP ini vars
        'phpIni' => [
            'display_startup_errors' => '1',
            'display_errors' => '1',
        ],

        // Startup functions
        'startup' => [
            'error_reporting' => E_ALL,
            'set_time_limit' => 30
        ],

        'loader' => [

            // Path to app directory
            'path' => realpath(dirname(__FILE__)) . '/app',

            // Application namespace
            'namespace' => 'App',
        ],


        'asset' => [

            // Adding ?_=microtime()
            'underscore' => true,

            // prefix for assets
            'prefix' => '/assets',

            // JS settings
            'defer' => true,
            'async' => true
        ],

        // Database settings
        'db' => [
            'servers' => [[
                'host' => 'localhost',
                'port' => 27017
            ]],
            'driver' => 'mongodb',
            'db' => 'lightdb'
        ],

        // Storage settings
        'storage' => [
            'url' => 'https://{ STORAGE DOMAIN }/',
            'route' => '_storage',
            'key' => '{ STORAGE KEY }'
        ],

        // Google Firebase Cloud Messaging settings
        'fcm' => [
            'key' => '{ PUT FCM KEY HERE }'
        ],

        // Default headers
        'headers' => [
            '{ HEADER NAME }' => '{ HEADER TITLE }',
        ],

        'admin' => [

            // will be used 'Light.Admin' as default
            'title' => '{ PROJECT TITLE }',

            'auth' => [
                'route' => '_auth',
                'cookieName' => 'authIdentity',
                'login' => 'root',
                'password' => '1',
            ],

            'menu' => [
                [
                    'title' => 'Multiple Menu Item',
                    'icon' => '{ MENU ITEM ICON }',
                    'items' => [
                        // Same as SINGLE MENU ITEM

                        // Separator example
                        ['separator'],
                    ]
                ],
                [
                    'title' => 'Single Menu Item',
                    'icon' => '{ MENU ITEM ICON }',
                    'url' => ['controller' => '...']
                ],
                [
                    'title' => 'Хранилище',
                    'icon' => 'file',
                    'url' => ['controller' => '_storage']
                ],
            ]
        ]
    ],


    'router' => [

        // For all domains and subdomains
        'light.domain.com' => [

            // Module name for any domain
            // will be ignored if light.modules will not be specified
            'module' => 'face',

            // Use for customizing Light settings for current module
            'light' => [

                'headers' => [
                    'Cache-Control' => 'max-age=86400, must-revalidate',
                    'Vary' => 'User-Agent',
                    'Expires' => date('r', time() + 86400),
                    'Date' => date('r', time())
                ],

                // View renderer settings
                'view' => [
                    'minify' => true
                ],
            ],

            // If TRUE disallow to use unspecified urls
            // Ex. /{controller}/{action}/param1/value1
            'strict' => false,

            // Prefix for url
            'prefix' => '/:param',

            // Prefix injector
            'prefixInjector' => [

                'param' => function (string $param) {

                    // TODO: processing something
                    return $param;
                }
            ],

            'routes' => [

                // Route URL
                '/uri/:param1/:param2' => [

                    // Controller
                    'controller' => 'index',

                    // Action
                    'action' => 'item',

                    // Injector
                    //
                    // Index::item($param1, $param2);
                    //
                    // If injector function for the argument will be specified,
                    // it will be initialized with returned value.
                    //
                    // If injector function for the argument will NOT be specified,
                    // it will be initialized just with string values parsed from request URI
                    //
                    // Ex. Index::item(SomeClass $param1, int $param2);
                    // $param1 - will be initialized - new SomeClass( {string value from requested URI} )
                    // $param2 - will try URI parameter convert to to INT
                    //
                    'injector' => [

                        'param1' => function ($param1) {

                            // ....

                            return $param1;
                        },
                    ]
                ],
            ],
        ],

        'admin.domain.com' => [
            // Possible settings explained for '*'
            'module' => 'admin',
        ],

        'api.domain.com' => [
            // Possible settings explained for '*'
            'module' => 'api',
        ],

        // Applied if the requested domain is not in the routes list
        '*' => [
            'module' => 'face'
        ],

        // Exactly for CLI mode.
        // Applied automatically if php run from cli mode
        'cli' => [
            // Possible settings explained for '*'
            'module' => 'cli'
        ],
    ],
];
