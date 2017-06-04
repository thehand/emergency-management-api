<?php

/** @var Slim\App $app */
$container = $app->getContainer();

$container['db'] = function (\Slim\Container $c) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($c->get('dbConnection'));

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$container[\WalletLogger\WalletsController::class] = function (\Slim\Container $c) {
    $table = $c->get('db')->table('wallets');

    return new \WalletLogger\WalletsController($table);
};

$container[\WalletLogger\AccountsController::class] = function (\Slim\Container $c) {
    $table = $c->get('db')->table('accounts');

    return new \WalletLogger\AccountsController($table);
};

$container[\WalletLogger\TransactionsController::class] = function (\Slim\Container $c) {
    $table = $c->get('db')->table('transactions');

    return new \WalletLogger\TransactionsController($table);
};