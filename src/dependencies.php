<?php

$container = $app->getContainer();

$container['wallets'] = function () {
    return new \WalletLogger\Wallets();
};