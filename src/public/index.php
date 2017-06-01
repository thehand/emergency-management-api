<?php

require __DIR__ . '/../vendor/autoload.php';

// TODO: If settings.php file does not exists throw an exception and warn users
require __DIR__ . '/../settings.php';
$app = new \Slim\App($settings);

// Register dependencies
// TODO: If dependencies.php file does not exists throw an exception and warn users
require __DIR__ . '/../dependencies.php';

// Register routes
// TODO: If routes.php file does not exists throw an exception and warn users
require __DIR__ . '/../routes.php';

// Run
$app->run();