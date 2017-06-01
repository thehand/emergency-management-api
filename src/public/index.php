<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../settings.php';
$app = new \Slim\App($settings);

// Register routes
require __DIR__ . '/../routes.php';

// Run
$app->run();