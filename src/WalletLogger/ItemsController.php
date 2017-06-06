<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Collection;
use Slim\Http\Request;
use Slim\Http\Response;
use WalletLogger\Interfaces\ItemsControllerInterface;

class ItemsController implements ItemsControllerInterface
{
    protected $order_by = 'id';

    /** @var ItemsModel $model */
    protected $model;

    /** @var Manager $db */
    protected $db;

    public function listItems(Request $request, Response $response, Array $args)
    {
        $filters = $args;
        $filters['deleted_at'] = null;

        /** @var Collection $items */
        $items = $this->model->getList($filters,$this->order_by);
        if ($items->count() > 0) {
            foreach ($items as $k => $item) {
                $item->total_amount = $this->getTotalAmount($item->id);
            }
            return $this->returnData($response, $items);
        }

        return $this->returnNoRecordsFound($response);
    }

    public function getItem(Request $request, Response $response, Array $args)
    {
        $item = $this->model->getItem($args['id']);
        if ($item->id > 0 && null === $item->deleted_at) {
            $item->total_amount = $this->getTotalAmount($item->id);

            return $this->returnData($response, $item);
        }

        return $this->returnNotFound($response);
    }

    public function createItem(Request $request, Response $response, Array $args)
    {
        try {
            $params = array_merge($args,$request->getParsedBody());
            $item = $this->model->createItem($params);

            return $this->getItem($request, $response, ['id' => $item]);
        } catch (\Exception $exception) {
            return $this->returnServerError($response);
        }
    }

    public function updateItem(Request $request, Response $response, Array $args)
    {
        try {
            $update = $this->model->updateItem($args['id'], $request->getParsedBody());
            if ($update) {
                return $this->getItem($request, $response, $args);
            }
            return $this->returnServerError($response);
        } catch (\Exception $exception) {
            return $this->returnServerError($response);
        }
    }

    public function deleteItem(Request $request, Response $response, Array $args)
    {
        try {
            $item = $this->model->getItem($args['id']);
            if ($item->id > 0 && null === $item->deleted_at) {
                $delete = $this->model->updateItem($args['id'], ['deleted_at' => date('Y-m-d H:i:s')]);
                if ($delete) {
                    return $this->returnData($response, null);
                }
            }

            return $this->returnNotFound($response);
        } catch (\Exception $exception) {
            return $this->returnServerError($response);
        }
    }

    public function getTotalAmount($item_id)
    {
        return 0;
    }

    public function returnData(Response $response, $items)
    {
        $output = [
            'status' => 200,
            'message' => 'OK',
            'total_items' => count($items),
            'item' => $items,
        ];

        return $response->withStatus(200)->withJson($output);
    }

    public function returnNoRecordsFound(Response $response)
    {
        $output = [
            'status' => 200,
            'message' => 'No Records Found',
            'total_items' => 0,
            'item' => [],
        ];

        return $response->withStatus(200)->withJson($output);
    }

    public function returnNotFound(Response $response)
    {
        $output = [
            'status' => 404,
            'message' => 'Not Found',
            'total_items' => 0,
            'item' => null,
        ];

        return $response->withStatus(404)->withJson($output);
    }

    public function returnServerError(Response $response)
    {
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