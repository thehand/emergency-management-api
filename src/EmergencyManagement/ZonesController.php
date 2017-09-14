<?php

namespace EmergencyManagement;

use Illuminate\Database\Capsule\Manager;

class ZonesController extends ItemsController
{
    public function __construct(Manager $db)
    {
        $this->db = $db;
        $this->model = new Zones($this->db);
        $this->order_by = 'created_at';
        $this->order_by_desc = true;
    }
}