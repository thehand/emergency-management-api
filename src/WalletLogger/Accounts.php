<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;

class Accounts extends ItemsModel
{
    public function __construct(Builder $table)
    {
        parent::__construct($table);

        $this->mandatory_fields = [
            'name',
            'fk_wallet_id'
        ];
    }
}