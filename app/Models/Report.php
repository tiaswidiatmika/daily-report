<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['date'];

    // relation to post
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function checkTodaysReport ()
    {
        $today = today()->date;
        return $this->where('date', $today)->first() !== null ? true : false;
    }
}
