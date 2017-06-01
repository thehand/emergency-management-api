<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;

class TransactionsController extends ItemsController
{
    public function __construct(Builder $table)
    {
        parent::__construct($table);
        $this->order_by = 'transaction_date';
    }
}