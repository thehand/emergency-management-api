<?php

/**
 * Register routes for each available item types
 */
foreach ($app->getContainer()['item_types'] as $item_type) {
    $app->group('/' . $item_type, function () use ($item_type) {
        // List all items
        $this->get('', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:listItems');

        // Get item's data
        $this->get('/{id:[0-9]+}', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:getItem');

        // Create a new item
        $this->post('', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:createItem');

        // Update an item
        $this->patch('/{id:[0-9]+}', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:updateItem');

        // Delete an item
        $this->delete('/{id:[0-9]+}', 'WalletLogger\\' . ucfirst($item_type) . 'Controller:deleteItem');
    });
}

/**
 * Generic fallback route
 */
$app->any('[/{path:.*}]', function ($request, $response, $args) {
    return $response->withStatus(400)->withJson(['message' => 'Bad request']);
});