<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\UserRepositoryInterface::class, \App\Repositories\AppUserRepository::class);
        $this->app->bind(\App\Repositories\Contracts\WalletTransactionRepositoryInterface::class, \App\Repositories\WalletTransactionRepository::class);
        $this->app->bind(\App\Repositories\Contracts\DonationRepositoryInterface::class, \App\Repositories\DonationRepository::class);
    }
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
