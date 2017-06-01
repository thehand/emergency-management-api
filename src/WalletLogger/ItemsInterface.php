<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;
use Slim\Http\Request;
use Slim\Http\Response;

interface ItemsInterface
{
    public function __construct(Builder $table);

    public function getItem(Request $request, Response $response, Array $args);

    public function createItem();

    public function updateItem();

    public function deleteItem();

    public function listItems(Request $request, Response $response, Array $args);
}