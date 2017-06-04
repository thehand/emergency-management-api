<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class Transactions extends ItemsModel
{
    protected $table_name = 'transactions';

    public function __construct(Manager $db)
    {
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