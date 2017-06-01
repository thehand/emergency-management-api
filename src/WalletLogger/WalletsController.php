<?php

namespace WalletLogger;

use Slim\Http\Request;
use Slim\Http\Response;

class WalletsController implements ItemsInterface
{
    public function listItems(Request $request, Response $response, Array $args)
    {
        return $response->withStatus(200)->withJson(array(1, 2, 3));
    }

    public function getItem()
    {
    }

    public function createItem()
    {
    }

    public function updateItem()
    {
    }

    public function deleteItem()
    {
    }
}