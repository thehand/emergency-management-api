<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class Wallets extends ItemsModel
{
    public function __construct(Manager $db)
    {
        $this->table_name = 'wallets';

        parent::__construct($db);

        $this->mandatory_fields = [
            'name',
            'fk_user_id'
        ];
    }
}