<?php

namespace App\Models;

use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shift extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reports()
    {
        return $this->hasMany( Report::class );
    }
}
