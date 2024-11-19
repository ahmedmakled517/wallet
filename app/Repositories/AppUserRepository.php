<?php
namespace App\Repositories;

use App\Models\AppUsers;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AppUserRepository implements UserRepositoryInterface
{
    public function getAuthenticatedUser()
    {
        return Auth::guard('app_users')->user();
    }

    public function updateWalletBalance($userId, $amount)
    {
        $user = AppUsers::find($userId);
        $user->wallet_balance += $amount;
        $user->save();
        return $user;
    }
}

