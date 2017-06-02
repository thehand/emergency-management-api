<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;

class Transactions extends ItemsModel
{
    public function __construct(Builder $table)
    {
        parent::__construct($table);

        $this->mandatory_fields = [
            'fk_account_id',
            'transaction_date',
            'description',
            'amount',
            'direction'
        ];
    }
}