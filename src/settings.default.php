<?php
date_default_timezone_set('Europe/Rome');

$settings = [
    'displayErrorDetails' => true,

    'dbConnection' => [
        'driver' => 'mysql',
        'host' => 'CHOOSE_YOUR_SOURCE_HOST',
        'username' => 'CHOOSE_YOUR_DB_USER',
        'password' => 'CHOOSE_YOUR_DB_PASSWORD',
        'database' => 'wallet_logger',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ],

    'item_types' => [
        'wallets',
        'accounts',
        'transactions'
    ],
];
