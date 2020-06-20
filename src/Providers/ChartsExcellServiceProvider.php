<?php

namespace App\Providers;

use App\Services\ChartsExcell;
use Illuminate\Support\ServiceProvider;

class ChartsExcellServiceProvider extends ServiceProvider
{
    public function register() {}
    public function boot()
    {
        // em minusculo
        app()->bind('chartsexcell', function () {
            return new ChartsExcell();
        });
    }
}
