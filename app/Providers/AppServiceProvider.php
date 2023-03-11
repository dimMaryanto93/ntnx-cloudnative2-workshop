<?php

namespace App\Providers;

use App\Client;
use App\Observers\ClientObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Client::observe(ClientObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */

     public function register()
    {
        //
    }
}
