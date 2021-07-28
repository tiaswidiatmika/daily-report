<?php
use Carbon\Carbon;

// build date and time for today
if ( !function_exists('todayIs') ) {
    function todayIs () {
        $today = Carbon::now('Asia/Shanghai')->locale('id');
        $today->settings(['formatFunction' => 'translatedFormat']);
        $date = $today->format('l, j F Y');
        $hour = $today->format('h:i');
        $todayIs = (object) [
            'date' => $date,
            'time' => $hour,
        ];
        return $todayIs;
    }
}
