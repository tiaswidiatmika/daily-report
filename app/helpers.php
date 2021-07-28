<?php
use Carbon\Carbon;

// build date and time for today
if ( !function_exists('todaysDateTime') ) {
    function todaysDateTime () {
        $today = Carbon::now('Asia/Shanghai')->locale('id');
        $today->settings(['formatFunction' => 'translatedFormat']);
        $date = $today->format('l, j F Y');
        $hour = $today->format('h:i');
        $obj = (object) [
            'date' => $date,
            'time' => $hour,
        ];
        return $obj;
    }
}
