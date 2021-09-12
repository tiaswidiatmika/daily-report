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

    public function create ()
    {
        return view('livewire.presence-form');
    }
    

    
}
