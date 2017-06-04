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
    return new \WalletLogger\WalletsController($c->get('db'));
};

$container[\WalletLogger\AccountsController::class] = function (\Slim\Container $c) {
    return new \WalletLogger\AccountsController($c->get('db'));
};

$container[\WalletLogger\TransactionsController::class] = function (\Slim\Container $c) {
    return new \WalletLogger\TransactionsController($c->get('db'));
};