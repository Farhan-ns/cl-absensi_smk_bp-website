<?php

use Carbon\Carbon;

if(!function_exists('getIndonesianTodaysDayName')) {
    function getIndonesianTodaysDayName() {
        return Carbon::today()->locale('id-ID')->dayName;
    }
}