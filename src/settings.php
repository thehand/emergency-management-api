<?php
date_default_timezone_set('Europe/Rome');

$settings = [
    'displayErrorDetails' => true,

    'dbConnection' => [
        'driver' => 'mysql',
        'host' => 'shake',
        'username' => 'a',
        'password' => 'b',
        'database' => 't',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ],

    'item_types' => [
        'users',
        'zones',
        'message_types',
        'messages'
    ],
];

