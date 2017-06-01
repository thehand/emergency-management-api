<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;
use Slim\Http\Request;
use Slim\Http\Response;

interface ItemsInterface
{
    public function __construct(Builder $table);

    public function getItem(Request $request, Response $response, Array $args);

    public function createItem(Request $request, Response $response, Array $args);

    public function updateItem(Request $request, Response $response, Array $args);

    public function deleteItem(Request $request, Response $response, Array $args);

    public function listItems(Request $request, Response $response, Array $args);
}