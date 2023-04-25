<?php

namespace App\Http\Repositories;

use App\Models\Transaction;

class TransactionRepository
{

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data): Transaction {
        return Transaction::create($data);
    }

    /**
     * @param int $id
     * @return Transaction|null
     */
    public function findByTransationId(int $id): ?Transaction {
        return Transaction::where('transaction_id', $id)->first();
    }

}
