<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    Report,
    Position,
    Formation
};
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PresenceController extends Controller
{
    public function index ()
    {
        $users = User::all();
        $retrievedUserId = $users->pluck('id');
        return $retrievedUserId;
    }

    public function show ()
    {
        // $formations = ReportController::firstOrCreate()->formations()->get()->groupBy('position_id');
        return view('report.presence-skeleton', PresenceController::prepare());
    }

    public function create ()
    {
        return view('livewire.presence-form');
    }

    public static function prepare ()
    {
        $report = ReportController::firstOrCreate();

        $typePresent = Position::typePresent()->pluck('id')->toArray();

        $formations = $report->formations()
            ->with(['user', 'position'])
            ->get();

        $attendees = $formations->whereIn('position_id', $typePresent)->groupBy('position_id');
        $absentees =  $formations->whereNotIn('position_id', $typePresent)->groupBy('position_id');

        $onTheList = $attendees->flatten()->pluck('user_id')
            ->merge($absentees->flatten()->pluck('user_id'));

        return compact('report', 'attendees', 'absentees', 'onTheList');
    }
    

    
}
