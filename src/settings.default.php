<?php
date_default_timezone_set('Europe/Rome');

$settings = array(
    'displayErrorDetails' => true,

    'db' => array(
        'host' => 'CHOOSE_YOUR_SOURCE_HOST',
        'user' => 'CHOOSE_YOUR_DB_USER',
        'pass' => 'CHOOSE_YOUR_DB_PASSWORD',
        'dbname' => 'wallet_logger',
    ),

    'item_types' => array(
        'wallets',
        'accounts',
        'transactions'
    )
);
