<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class Accounts extends ItemsModel
{
    protected $table_name = 'accounts';

    public function __construct(Manager $db)
    {
        parent::__construct($db);

        $this->mandatory_fields = [
            'name',
            'fk_wallet_id'
        ];
    }
}