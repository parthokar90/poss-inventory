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
        // default string length
        Schema::defaultStringLength(191);

        try {

            if (Schema::hasTable('product_warehouses')) {

                $total_notification = ProductWarehouse::whereRaw(
                    'qty <= alert_qty'
                )->count();
            } else {

                $total_notification = 0;
            }
        } catch (\Exception $e) {

            // Ignore DB errors during CI / composer install / migrations
            $total_notification = 0;
        }

        view()->share('total_notification', $total_notification);
    }
}
