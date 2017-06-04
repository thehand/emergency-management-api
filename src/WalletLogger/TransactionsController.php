<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class TransactionsController extends ItemsController
{
    public function __construct(Manager $db)
    {
        $this->db = $db;
        $this->model = new Transactions($this->db);
        $this->order_by = 'transaction_date';
    }

    public function getTotalAmount($item_id)
    {
        $transaction = $this->model->getItem($item_id);

        return $transaction->direction === 'IN' ? $transaction->amount : 0 - $transaction->amount;
    }
}