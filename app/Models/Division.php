<?php

namespace App\Models;

use App\Models\Report;
use App\Models\SubDivision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;
    protected $guarded = [];
    const NAMES = [
        1 => 'Seksi Riksa I',
        2 => 'Seksi Riksa II',
        3 => 'Seksi Riksa III',
        4 => 'Seksi Riksa IV',
    ];
    const SUB_UNIT = [1, 2];

    public function subDivisions() 
    {
        return $this->hasMany( SubDivision::class );
    }

    public function report() 
    {
        return $this->belongsToMany( Report::class );
    }
}
