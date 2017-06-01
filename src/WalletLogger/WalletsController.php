<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;
use Slim\Http\Request;
use Slim\Http\Response;

class WalletsController implements ItemsInterface
{
    private $table;

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function listItems(Request $request, Response $response, Array $args)
    {
        return $response->withStatus(200)->withJson($this->table->get());
    }

    public function getItem(Request $request, Response $response, Array $args)
    {
        return $response->withStatus(200)->withJson($this->table->find($args['id']));
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