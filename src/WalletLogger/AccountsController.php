<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;

class AccountsController extends ItemsController
{
    public function __construct(Builder $table)
    {
        $this->model = new Accounts($table);
        $this->order_by = 'name';
    }
}