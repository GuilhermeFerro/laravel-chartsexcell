<?php

if ( ! function_exists('createcharts')) {
    /**
     * Initiate ChartsExcell hook.
     *
     * @return Gsferro\ChartsExcell\Services\ChartsExcell
     */
    function chartsexcell()
    {
        return app('chartsexcell');
    }
}