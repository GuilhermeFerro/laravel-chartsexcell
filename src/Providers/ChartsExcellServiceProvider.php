<?php

namespace Gsferro\ChartsExcell;

use Gsferro\ChartsExcell\Services\ChartsExcell;
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

        /*
        |---------------------------------------------------
        | Publish
        |---------------------------------------------------
        */
        // Facades
        $this->publishes([
//            __DIR__.'/Facades/ChartsExcell.php' => app_path('Facades/ChartsExcell.php'),
        // Helpers
//            __DIR__.'/Helpers/chartsexcell.php' => app_path('Helpers/chartsexcell.php'),
        // Providers
//            __DIR__.'/Providers/ChartsExcellServiceProvider.php' => app_path('Providers/ChartsExcellServiceProvider.php'),
        // Services
//            __DIR__.'/ServicesServices/ChartsExcell.php' => app_path('Services/ChartsExcell.php'),
        ]);
    }
}
