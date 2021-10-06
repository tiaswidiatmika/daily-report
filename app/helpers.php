<?php
use Carbon\Carbon;
use Illuminate\Support\Collection;

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

if ( !function_exists('loggedUser') ) {
    function loggedUser() {
        return auth()->user()->load('subDivision.division');
    }
}

// usage : $spv = teammatesWithRole($exceptKaunit, 'spv')->first();
// usage : $kaunit = teammatesWithRole( loggedUser()->subDivision->division->users, 'kaunit' )->first();
if ( !function_exists('teammatesWithRole') ) {
    function teammatesWithRole( $teammates, $role ) {
        return $teammates->filter( function ( $user ) use ( $role ) {
            return $user->hasRole( $role );
        } );
    }
}

if ( !function_exists('rejectUsersInCollection') ) {
    // reject collection, if its key contains something in array of keys
    function rejectUsersInCollection( Collection $needles, string $key, Array $haystack ) {
        return $needles->reject( function( $needle ) use ( $key, $haystack ) {
            return in_array($needle[$key], $haystack);
        } )->toArray();

    }
}

