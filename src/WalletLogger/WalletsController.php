<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;

class WalletsController extends ItemsController
{
    public function __construct(Builder $table)
    {
        $this->model = new Wallets($table);
        $this->order_by = 'name';
    }
}