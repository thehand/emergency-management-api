<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \WalletLogger\Wallets;

require __DIR__ . '/../vendor/autoload.php';

// Todo: If settings.php file does not exists throw an exception and warn users
require __DIR__ . '/../settings.php';
$app = new \Slim\App($settings);

// Register dependencies
require __DIR__ . '/../dependencies.php';

// Register routes
require __DIR__ . '/../routes.php';

// Run
$app->run();