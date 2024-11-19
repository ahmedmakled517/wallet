<?php
namespace App\Repositories;

use App\Models\WalletTransaction;
use App\Repositories\Contracts\WalletTransactionRepositoryInterface;

class WalletTransactionRepository implements WalletTransactionRepositoryInterface
{
    public function createTransaction(array $data)
    {
        return WalletTransaction::create($data);
    }
}

