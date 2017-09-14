<?php

namespace EmergencyManagement;

use Illuminate\Database\Capsule\Manager;

class Zones extends ItemsModel
{
    public function __construct(Manager $db)
    {
        $this->table_name = 'zones';

        parent::__construct($db);

        $this->mandatory_fields = [
            'name',
            'description',
            'fk_user_id'
        ];
    }
}