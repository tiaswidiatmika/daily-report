<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'is_complete'];
    protected $with = ['posts'];

    // relation to post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function complete()
    {
        $this->is_complete = true;
        $this->save();
        return $this;
    }

    public static function checkTodaysReport ()
    {
        $today = todayIs()->date;
        return Report::where('date', $today)->first() !== null ? true : false;
    }

    public static function today ()
    {
        return Report::where( 'date', todayIs()->date )->first();
    }
}
