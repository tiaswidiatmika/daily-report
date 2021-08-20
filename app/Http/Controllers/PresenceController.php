<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;

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

    public function show ($id = 4)
    {
        var_dump (json_decode(Formation::find($id)->paspor_indonesia));
    }

    public function store(Request $request)
    {
        $record = $this->getFormation( $request );
        $record = Formation::create( $record );
        $positions = $record->getFillable();
        $formation = $this->tableRecordToArray( $record );
        $formation = $this->transformToFullName( $formation );
        return view('report.presence-report', compact('positions','formation'));
    }

    public function getFormation ( $request )
    {
        $formation = [];
        // * retrieve the formations_table fillable column
        $tableColumns = Formation::getFillables();
        // $tableColumns = collect($tableColumns);

        foreach ($tableColumns as $column) {
            $formation[$column] = json_encode ( explode(',', $request->$column) );
        }
        return $formation;
    }

    public function tableRecordToArray ( $record )
    {
        // overwrite fillable value with json decode
        $formation = [];
        foreach ( $record->getFillable() as $tableAttribute ) {
            $formation[$tableAttribute] = json_decode( $record->$tableAttribute );
        }
        return $formation;
    }

    
}
