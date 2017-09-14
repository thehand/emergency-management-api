<?php

namespace EmergencyManagement\Interfaces;

use Slim\Http\Request;
use Slim\Http\Response;

interface ItemsControllerInterface
{
    public function listItems(Request $request, Response $response, Array $args);

    public function getItem(Request $request, Response $response, Array $args);

    public function createItem(Request $request, Response $response, Array $args);

    public function updateItem(Request $request, Response $response, Array $args);

    public function deleteItem(Request $request, Response $response, Array $args);

    public function returnData(Response $response, $items);

    public function returnNotFound(Response $response);

    public function returnNoRecordsFound(Response $response);

    public function returnServerError(Response $response);
}