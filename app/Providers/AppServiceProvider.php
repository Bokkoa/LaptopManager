<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//FOR STRING LENGTH
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //for not problem on migrate
        Schema::defaultStringLength(191);
    }
}
