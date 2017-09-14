<?php
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

/** @var Slim\App $app */
$app->group('/zones', function () {
    $this->get('', 'EmergencyManagement\ZonesController:listItems'); // List all zones
    $this->get('/{id:[0-9]+}', 'EmergencyManagement\ZonesController:getItem'); // Get a wallet
    $this->post('', 'EmergencyManagement\ZonesController:createItem'); // Create a new wallet
    $this->post('/{id:[0-9]+}', 'EmergencyManagement\ZonesController:updateItem'); // Update a wallet
    $this->delete('/{id:[0-9]+}', 'EmergencyManagement\ZonesController:deleteItem'); // Delete a wallet
})
    ->add($addCORS)
    ->add(new \Slim\Middleware\TokenAuthentication([
        'path' => '/zones',
        'authenticator' => $this->authenticator,
        'secure' => false,
    ]));

$app->group('/messages', function () {
    $this->get('', 'EmergencyManagement\MessagesController:listItems'); // List all zones
    $this->get('/{id:[0-9]+}', 'EmergencyManagement\MessagesController:getItem'); // Get a wallet
    $this->post('', 'EmergencyManagement\MessagesController:createItem'); // Create a new wallet
    $this->post('/{id:[0-9]+}', 'EmergencyManagement\MessagesController:updateItem'); // Update a wallet
    $this->delete('/{id:[0-9]+}', 'EmergencyManagement\MessagesController:deleteItem'); // Delete a wallet
})
    ->add($addCORS)
    ->add(new \Slim\Middleware\TokenAuthentication([
        'path' => '/zones',
        'authenticator' => $this->authenticator,
        'secure' => false,
    ]));

/**
 * Return an empty response for every other routes
 */
$app->any('[/{path:.*}]', function (\Slim\Http\Request $request, \Slim\Http\Response $response, Array $args) {
    return $response->withStatus(403);
})->add($addCORS);