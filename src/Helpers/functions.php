<?php

if ( ! function_exists('createcharts')) {
    /**
     * Initiate ChartsExcell hook.
     *
     * @return \App\Services\ChartsExcell
     */
    function chartsexcell()
    {
        return app('chartsexcell');
    }
}