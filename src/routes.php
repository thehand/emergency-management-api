<?php
/** @var Slim\App $app */
$addCORS = function (\Psr\Http\Message\ServerRequestInterface $req, \Psr\Http\Message\ResponseInterface $res, $next) {
    /** @var \Psr\Http\Message\ResponseInterface $response */
    $response = $next($req, $res, null);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, DELETE, OPTIONS');
};

/**
 * Register routes to follow the hierarchy of items
 */
$app->post('/login', 'WalletLogger\UsersController:tryLogin');

$app->group('/wallets', function () use ($app) {
    $this->get('', 'WalletLogger\WalletsController:listItems'); // List all wallets
    $this->get('/{id:[0-9]+}', 'WalletLogger\WalletsController:getItem'); // Get a wallet
    $this->post('', 'WalletLogger\WalletsController:createItem'); // Create a new wallet
    $this->post('/{id:[0-9]+}', 'WalletLogger\WalletsController:updateItem'); // Update a wallet
    $this->options('/{id:[0-9]+}', 'WalletLogger\WalletsController:getItem'); // Enable options method
    $this->delete('/{id:[0-9]+}', 'WalletLogger\WalletsController:deleteItem'); // Delete a wallet

    $app->group('/{fk_wallet_id:[0-9]+}/accounts', function () use ($app) {
        $this->get('', 'WalletLogger\AccountsController:listItems'); // List all accounts for a specific wallet
        $this->get('/{id:[0-9]+}', 'WalletLogger\AccountsController:getItem'); // Get an account
        $this->post('', 'WalletLogger\AccountsController:createItem'); // Create a new account
        $this->post('/{id:[0-9]+}', 'WalletLogger\AccountsController:updateItem'); // Update a account
        $this->options('/{id:[0-9]+}', 'WalletLogger\AccountsController:getItem'); // Enable options method
        $this->delete('/{id:[0-9]+}', 'WalletLogger\AccountsController:deleteItem'); // Delete a account

        $app->group('/{fk_account_id:[0-9]+}/transactions', function () {
            $this->get('', 'WalletLogger\TransactionsController:listItems'); // List all transactions
            $this->get('/{id:[0-9]+}', 'WalletLogger\TransactionsController:getItem'); // Get a transaction
            $this->post('', 'WalletLogger\TransactionsController:createItem'); // Create a new transaction
            $this->post('/{id:[0-9]+}', 'WalletLogger\TransactionsController:updateItem'); // Update a transaction
            $this->options('/{id:[0-9]+}', 'WalletLogger\TransactionsController:getItem'); // Enable options method
            $this->delete('/{id:[0-9]+}', 'WalletLogger\TransactionsController:deleteItem'); // Delete a transaction
        });
    });
})
    ->add($addCORS)
    ->add(new \Slim\Middleware\TokenAuthentication([
        'path' => '/wallets',
        'authenticator' => $this->authenticator
    ]));

/**
 * Generic fallback route
 */
$app->any('[/{path:.*}]', function (\Slim\Http\Request $request, \Slim\Http\Response $response, Array $args) {
    return $response->withStatus(400)->withJson([
        'status' => 400,
        'message' => 'Bad request',
        'path' => $args['path'],
        'method' => $request->getMethod(),
        'passed_args' => $args
    ]);
});