<?php

namespace Gsferro\ChartsExcell\Facades;

use Illuminate\Support\Facades\Facade;

class ChartsExcell extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'chartsexcell'; // em minusculo
    }
}