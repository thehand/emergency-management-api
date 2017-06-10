<?php

namespace WalletLogger;

use Illuminate\Database\Capsule\Manager;

class WalletsController extends ItemsController
{
    public function __construct(Manager $db)
    {
        $this->db = $db;
        $this->model = new Wallets($this->db);
        $this->order_by = 'name';
        $this->order_by_desc = false;
    }

    public function getTotalAmount($item_id)
    {
        $total = 0;

        $related_accounts = (new Accounts($this->db))->getList(['fk_wallet_id' => $item_id]);
        foreach ($related_accounts as $account) {
            $related_transactions = (new Transactions($this->db))->getList(['fk_account_id' => $account->id]);
            foreach ($related_transactions as $transaction) {
                $transaction->direction === 'IN' ? $total += $transaction->amount : $total -= $transaction->amount;
            }
        }

        return $total;
    }
}