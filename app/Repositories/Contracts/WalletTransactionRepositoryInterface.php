<?php
namespace App\Repositories\Contracts;

interface WalletTransactionRepositoryInterface
{
    public function createTransaction(array $data);
}
