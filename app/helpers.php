<?php
use Carbon\Carbon;

// build date and time for today
if ( !function_exists('todayIs') ) {
    function todayIs () {
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

if ( !function_exists('replaceWhiteSpace') ) {
    function replaceWhiteSpace( $haystack ) {
        return preg_replace('/\s/', '_', $haystack);
    }
}
if ( !function_exists('replaceSquareBrackets') ) {
    function replaceSquareBrackets( $haystack ) {
        return preg_replace('/\[|\]/', '', $haystack);
    }
}

if ( !function_exists('replaceUnderScore') ) {
    function replaceUnderScore( $haystack ) {
        return str_replace('_', ' ', $haystack);
    }
}

