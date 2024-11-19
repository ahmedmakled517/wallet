<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAuthenticatedUser();
    public function updateWalletBalance($userId, $amount);
}
