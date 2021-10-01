<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'count_absent'];
    
    public function scopeTypePresent ( $query )
    {
        return $query->where('count_absent', false);
    }

    public function scopeTypeAbsent ( $query )
    {
        return $query->where('count_absent', true);
    }

    public function scopeExemptedFromReport( $query )
    {
        return $query->whereIn('name', ['spv', 'asisten_spv'])->pluck('id');
    }

    public function getDisplayNameAttribute()
    {
        return ucwords( str_replace('_', ' ', $this->name) );
    }
}
