<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\product\ProductWarehouse;
use App\varients\ProductVarient;

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
        //default string length
        Schema::defaultStringLength(191);
        
        $total_notification=ProductWarehouse::whereRaw('qty <= alert_qty')->count();
        view()->share('total_notification',$total_notification);
    }
}
