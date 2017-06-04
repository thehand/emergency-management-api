<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class Transactions extends ItemsModel
{
    public function __construct(Manager $db)
    {
        $this->table_name = 'transactions';

        parent::__construct($db);

        $this->mandatory_fields = [
            'fk_account_id',
            'transaction_date',
            'description',
            'amount',
            'direction'
        ];
    }
}