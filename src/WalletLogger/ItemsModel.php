<?php

namespace WalletLogger;

use Illuminate\Database\Query\Builder;

class ItemsModel
{
    protected $table;

    public $mandatory_fields = [];

    public $optional_fields = ['deleted_at'];

    public function __construct(Builder $table)
    {
        $this->table = $table;
    }

    public function getList($params)
    {
        return $this->table
            ->orderBy(!empty($params['order_by']) ? $params['order_by'] : 'id')
            ->get()
            ->where('deleted_at', null);
    }

    public function getItem($id)
    {
        return $this->table
            ->find($id);
    }

    public function createItem($item_data)
    {
        $parsed_fields = array();
        // Check if there are all mandatory fields
        foreach ($this->mandatory_fields as $field) {
            if (!isset($item_data[$field])) {
                throw new \InvalidArgumentException('Mandatory field `' . $field . '` is missing', 500);
            }
            $parsed_fields[$field] = $item_data[$field];
        }

        // Clear passed array to leave only mandatory and optional fields
        foreach ($this->optional_fields as $field) {
            if (isset($item_data[$field])) {
                $parsed_fields[$field] = $item_data[$field];
            }
        }

        return $this->table->insertGetId($parsed_fields);
    }

    public function updateItem($item_id, Array $updated_data)
    {
        $item = $this->table->find((int)$item_id);
        if ($item) {
            $parsed_fields = array();
            $available_fields = array_merge($this->mandatory_fields,$this->optional_fields);

            // Clear passed array to leave only mandatory and optional fields
            foreach ($available_fields as $field) {
                if (isset($updated_data[$field])) {
                    $parsed_fields[$field] = $updated_data[$field];
                }
            }

            return $this->table->update($parsed_fields);
        }

        return false;
    }
}