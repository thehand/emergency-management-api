<?php
/**
 * Register specific routes for each available item types
 */
foreach ($app->getContainer()['item_types'] as $item_type) {
    $app->group('/' . $item_type, function () use ($item_type) {
        $this->get('', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:listItems')->setName('getList' . ucfirst($item_type)); // List all items
        $this->get('/{id:[0-9]+}', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:getItem')->setName('getItem' . ucfirst($item_type)); // Get item's data
        $this->post('', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:createItem'); // Create a new item
        $this->post('/{id:[0-9]+}', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:updateItem'); // Update an item
        // Should be more correct use PATCH verb to update an item but Slim seems to have problems with getParsedBody method :(
        $this->delete('/{id:[0-9]+}', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:deleteItem'); // Delete an item
    });
}

/**
 * Register routes to follow the hierarchy of items
 */
$app->group('/wallets', function () use ($app) {
    $app->group('/{fk_wallet_id:[0-9]+}/accounts', function () use ($app) {
        $this->get('', 'WalletLogger\AccountsController:listItems'); // List all accounts
        $this->get('/{id:[0-9]+}', 'WalletLogger\AccountsController:getItem'); // Get an account
        $this->post('', 'WalletLogger\AccountsController:createItem'); // Create a new account
        $this->post('/{id:[0-9]+}', 'WalletLogger\AccountsController:updateItem'); // Update a account
        $this->delete('/{id:[0-9]+}', 'WalletLogger\AccountsController:deleteItem'); // Delete a account

        $app->group('/{fk_account_id:[0-9]+}/transactions', function () use ($app) {
            $this->get('', 'WalletLogger\TransactionsController:listItems'); // List all transactions
            $this->get('/{id:[0-9]+}', 'WalletLogger\TransactionsController:getItem'); // Get a transaction
            $this->post('', 'WalletLogger\TransactionsController:createItem'); // Create a new transaction
            $this->post('/{id:[0-9]+}', 'WalletLogger\TransactionsController:updateItem'); // Update a transaction
            $this->delete('/{id:[0-9]+}', 'WalletLogger\TransactionsController:deleteItem'); // Delete a transaction
        });
    });
});

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