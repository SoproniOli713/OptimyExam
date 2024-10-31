<?php

/**
 * 
 */
return [

    'mysql' => [
        'username' => env('DB_USERNAME', 'user'),
        'password' => env('DB_PASSWORD', ''),
        'database' => env('DB_DATABASE', 'app'),
        'port' => env('DB_PORT', 3360),
        'host' => env('DB_HOST', '127.0.0.1'),
    ]

];

// TODO:: for future, if the database will make use of other connections then can configure it here