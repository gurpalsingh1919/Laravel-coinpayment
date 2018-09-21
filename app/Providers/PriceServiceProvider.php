<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use View;

class PriceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting =  Setting::find(1);

        View::share('c_btc', $setting->btc_price);
        View::share('c_eth', $setting->eth_price);
        View::share('c_ltc', $setting->ltc_price);
        View::share('c_bch', $setting->bch_price);
        View::share('c_rate',$setting->usd_rate);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
