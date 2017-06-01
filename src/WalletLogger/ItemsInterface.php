<?php

namespace WalletLogger;

use Slim\Http\Request;
use Slim\Http\Response;

interface ItemsInterface
{
    public function getItem(Request $request, Response $response, Array $args);

    public function createItem();

    public function updateItem();

    public function deleteItem();

    public function listItems(Request $request, Response $response, Array $args);
}