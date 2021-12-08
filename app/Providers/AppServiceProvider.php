<?php

namespace App\Providers;

use App\Models\MseIpList;
use App\Observers\MseIpListObserver;
use Illuminate\Support\ServiceProvider;

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
        MseIpList::observe(MseIpListObserver::class);
    }
}
