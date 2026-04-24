<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\product\ProductWarehouse;

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
        Schema::defaultStringLength(191);

        if (app()->runningInConsole() || app()->environment('testing')) {
            return;
        }

        $total_notification = ProductWarehouse::whereRaw('qty <= alert_qty')->count();
        view()->share('total_notification', $total_notification);
    }
}
