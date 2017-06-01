<?php

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