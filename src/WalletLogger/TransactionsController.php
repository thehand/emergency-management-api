<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;

class TransactionsController extends ItemsController
{
    public function __construct(Builder $table)
    {
        $this->model = new Transactions($table);
        $this->order_by = 'transaction_date';
    }
}