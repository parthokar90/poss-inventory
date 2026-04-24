<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        $total_notification = 0;

        if (!app()->runningInConsole() && !app()->environment('testing')) {

            try {
                $total_notification = DB::table('product_warehouses')
                    ->whereColumn('qty', '<=', 'alert_qty')
                    ->count();

            } catch (\Exception $e) {
                $total_notification = 0;
            }
        }

        view()->share('total_notification', $total_notification);
    }
}