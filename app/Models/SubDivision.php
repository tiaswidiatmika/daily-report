<?php

namespace App\Models;

use App\Models\Division;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubDivision extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function users()
    {
        return $this->belongsToMany( User::class );
    }
}
