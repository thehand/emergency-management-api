<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;
use Slim\Http\Request;
use Slim\Http\Response;

class ItemsController implements ItemsInterface
{
    protected $table;
    protected $order_by;

    public function __construct(Builder $table)
    {
        /** @var Builder table */
        $this->table = $table;
        $this->order_by = 'id';
    }

    public function listItems(Request $request, Response $response, Array $args)
    {
        // TODO: Check if item exists, if so, return it
        return $response->withStatus(200)->withJson($this->table->orderBy($this->order_by)->get()->where('deleted_at',null));
    }

    public function getItem(Request $request, Response $response, Array $args)
    {
        // TODO: Check if item was deleted and if exists, return it
        return $response->withStatus(200)->withJson($this->table->find($args['id']));
    }

    public function createItem(Request $request, Response $response, Array $args)
    {
        $post_data = $request->getParsedBody();
        $item = $this->table->insert($post_data);

        return $response->withStatus(200)->withJson($item);
    }

    public function updateItem(Request $request, Response $response, Array $args)
    {
        $update = false;
        $post_data = $request->getParsedBody();

        $item = $this->table->find($args['id']);
        if ($item) {
            $update = $this->table->update($post_data);
        }

        return $response->withStatus(200)->withJson($update);
    }

    public function deleteItem(Request $request, Response $response, Array $args)
    {
        $update = false;

        $item = $this->table->find($args['id']);
        if ($item) {
            $update = $this->table->update(['deleted_at' => date('Y-m-d H:i:s')]);
        }

        return $response->withStatus(200)->withJson($update);
    }
}