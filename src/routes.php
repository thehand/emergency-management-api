<?php

/**
 * Wallets routes
 */
$app->group('/wallets', function () {
    $this->get('', function ($request, $response, $args) {
        // TODO: Use db to retrieve the list of wallets
    });
    $this->post('', function ($request, $response, $args) {
        // TODO: Use db to create a new wallet
    });
    $this->patch('/{id:[0-9]+}', function ($request, $response, $args) {
        // TODO: Use db to update a wallet
    });
    $this->delete('/{id:[0-9]+}', function ($request, $response, $args) {
        // TODO: Use db to delete a wallet
    });
});


/**
 * Accounts routes
 */
$app->group('/accounts', function () {
    $this->get('', function ($request, $response, $args) {
        // TODO: Use db to retrieve the list of accounts
    });
    $this->post('', function ($request, $response, $args) {
        // TODO: Use db to create a new account
    });
    $this->patch('/{id:[0-9]+}', function ($request, $response, $args) {
        // TODO: Use db to update a account
    });
    $this->delete('/{id:[0-9]+}', function ($request, $response, $args) {
        // TODO: Use db to delete a account
    });
});


/**
 * Transactions routes
 */
$app->group('/transactions', function () {
    $this->get('', function ($request, $response, $args) {
        // TODO: Use db to retrieve the list of transactions
    });
    $this->post('', function ($request, $response, $args) {
        // TODO: Use db to create a new transaction
    });
    $this->patch('/{id:[0-9]+}', function ($request, $response, $args) {
        // TODO: Use db to update a transaction
    });
    $this->delete('/{id:[0-9]+}', function ($request, $response, $args) {
        // TODO: Use db to delete a transaction
    });
});

/**
 * Generic fallback route
 */
$app->any('[/{path:.*}]', function ($request, $response, $args) {
    return $response->withStatus(400)->withJson(['message' => 'Bad request']);
});