<?php

namespace App\Providers;

use App\Interfaces\DonationRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Repositories\DonationRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DonationRepositoryInterface::class, DonationRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
