<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \WalletLogger\WalletLoggerAPI();
$app->get()->run();