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
        $output = [
            'status' => 404,
            'message' => 'Not Found',
            'total_items' => 0,
            'items' => null,
        ];

        $items = $this->table->orderBy($this->order_by)->get()->where('deleted_at', null);
        if (count($items) > 0) {
            $output = [
                'status' => 200,
                'message' => 'OK',
                'total_items' => count($items),
                'items' => $items,
            ];
        }

        return $response->withStatus($output['status'])->withJson($output);
    }

    public function getItem(Request $request, Response $response, Array $args)
    {
        $output = [
            'status' => 404,
            'message' => 'Not Found',
            'total_items' => 0,
            'item' => null,
        ];

        $item = $this->table->find($args['id']);
        if ($item->id > 0 && null === $item->deleted_at) {
            $output = [
                'status' => 200,
                'message' => 'OK',
                'total_items' => 1,
                'item' => $item,
            ];
        }

        return $response->withStatus($output['status'])->withJson($output);
    }

    public function createItem(Request $request, Response $response, Array $args)
    {
        $post_data = $request->getParsedBody();
        $output = [
            'status' => 500,
            'message' => 'Internal Server Error',
            'total_items' => 0,
            'item' => null,
        ];

        try {
            // TODO: Check if for that user, a wallet with specified name already exists
            $item = $this->table->insertGetId($post_data);

            return $this->getItem($request, $response, ['id' => $item]);
        } catch (\Exception $exception) {
            // TODO: Maybe log errors?
            return $response->withStatus($output['status'])->withJson($output);
        }
    }

    public function updateItem(Request $request, Response $response, Array $args)
    {
        try {
            $update = $this->updateDBRow($args['id'], $request->getParsedBody());
            if ($update) {
                return $this->getItem($request, $response, $args);
            }
        } catch (\Exception $exception) {
            // TODO: Maybe log errors?
            $output = [
                'status' => 500,
                'message' => 'Internal Server Error',
                'total_items' => 0,
                'item' => null,
            ];
            return $response->withStatus(500)->withJson($output);
        }
    }

    public function deleteItem(Request $request, Response $response, Array $args)
    {
        try {
            // TODO: Maybe it can be smarter check first if the item was already deleted?
            $delete = $this->updateDBRow($args['id'], ['deleted_at' => date('Y-m-d H:i:s')]);
            if ($delete) {
                $output = [
                    'status' => 200,
                    'message' => 'OK',
                    'total_items' => 0,
                    'item' => null,
                ];

                return $response->withStatus(200)->withJson($output);
            }
        } catch (\Exception $exception) {
            $output = [
                'status' => 500,
                'message' => 'Internal Server Error',
                'total_items' => 0,
                'item' => null,
            ];
            return $response->withStatus(500)->withJson($output);
        }
    }

    public function updateDBRow($item_id, Array $updated_data)
    {
        $item = $this->table->find((int)$item_id);
        if ($item) {
            try {
                return $this->table->update($updated_data);
            } catch (\Exception $exception) {
                // TODO: Maybe log errors?
                return false;
            }

        }
    }
}