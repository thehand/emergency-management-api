<?php

namespace EmergencyManagement\Interfaces;

use Illuminate\Database\Capsule\Manager;

interface ItemsModelInterface
{
    public function __construct(Manager $db);

    public function getList(array $filters, $order_by = 'id');

    public function getItem($id);

    public function createItem($item_data);

    public function updateItem($item_id, Array $updated_data);
}