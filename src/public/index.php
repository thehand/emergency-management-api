<?php

require __DIR__ . '/../vendor/autoload.php';


$settings = [];
if (file_exists(__DIR__ . '/../settings.php')) {
    require __DIR__ . '/../settings.php';
} else {
    throw new \RuntimeException('Settings file is missing.');
}
$app = new \Slim\App($settings);

// Register dependencies
if (file_exists(__DIR__ . '/../dependencies.php')) {
    require __DIR__ . '/../dependencies.php';
} else {
    throw new \RuntimeException('Dependencies file is missing.');
}

// Register routes
if (file_exists(__DIR__ . '/../routes.php')) {
    require __DIR__ . '/../routes.php';
} else {
    throw new \RuntimeException('Routes file is missing.');
}

// Run
$app->run();