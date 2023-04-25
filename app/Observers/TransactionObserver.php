<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\User;

class TransactionObserver
{

    public function creating(Transaction $transaction): void {
        $transaction->user_id = User::first()->id;
    }

}
