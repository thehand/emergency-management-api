<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class Accounts extends ItemsModel
{
    public function __construct(Manager $db)
    {
        $this->table_name = 'accounts';

        parent::__construct($db);

        $this->mandatory_fields = [
            'name',
            'fk_wallet_id'
        ];
    }
}