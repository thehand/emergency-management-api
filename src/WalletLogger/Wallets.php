<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class Wallets extends ItemsModel
{
    protected $table_name = 'wallets';

    public function __construct(Manager $db)
    {
        parent::__construct($db);

        $this->mandatory_fields = [
            'name'
        ];
    }
}