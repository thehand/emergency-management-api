<?php

namespace EmergencyManagement;

use Illuminate\Database\Capsule\Manager;

class Messages extends ItemsModel
{
    public function __construct(Manager $db)
    {
        $this->table_name = 'messages';

        parent::__construct($db);

        $this->mandatory_fields = [
            'text',
            'fk_message_type_id',
            'fk_zone_id',
            'fk_user_id',
        ];
    }
}