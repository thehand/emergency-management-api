<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class AccountsController extends ItemsController
{
    public function __construct(Manager $db)
    {
        $this->db = $db;
        $this->model = new Accounts($this->db);
        $this->order_by = 'name';
    }

    public function getTotalAmount($item_id)
    {
        $total = 0;

        $related_transactions = (new Transactions($this->db))->getList(['fk_account_id' => $item_id]);
        foreach ($related_transactions as $transaction) {
            $transaction->direction === 'IN' ? $total += $transaction->amount : $total -= $transaction->amount;
        }

        return $total;
    }
}