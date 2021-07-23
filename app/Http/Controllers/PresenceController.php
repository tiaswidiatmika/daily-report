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

    public function show ($id = 4)
    {
        var_dump (json_decode(Formation::find($id)->paspor_indonesia));
    }

    public function store(Request $request)
    {
        // * retrieve the formations_table fillable column
        $tableColumns = new Formation;
        $tableColumns = collect($tableColumns->getFillables());

        // * create an array with key of formations_table's column names
        // * with the value of $request [ respective column name ]
        $formations = [];
        foreach ($tableColumns as $column) {
            $formations[$column] = $this->transformsToFullName($request[$column]);
        }
        Formation::insert($formations);
    }

    public function transformsToFullName(String $names)
    {
        $names = explode(',', $names);
        $names = collect($names)
            ->transform( function($alias) {
                return User::where('alias', $alias)->first()->name;
            } );
        // return implode("---", $names->toArray());
        return json_encode($names);
    }
}
