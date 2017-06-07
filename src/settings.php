<?php
date_default_timezone_set('Europe/Rome');

$settings = [
    'displayErrorDetails' => true,

    'dbConnection' => [
        'driver' => 'mysql',
        'host' => $_SERVER['RDS_HOSTNAME'],
        'username' => $_SERVER['RDS_USERNAME'],
        'password' => $_SERVER['RDS_PASSWORD'],
        'database' => $_SERVER['RDS_DB_NAME'],
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

