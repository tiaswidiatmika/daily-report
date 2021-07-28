<?php

namespace App\Models;

// use Spatie\Sluggable\HasSlug;
// use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;
    // use HasSlug;

    // protected $fillable = ['template_name', 'case', 'summary', 'chronology', 'measure', 'conclusion'];
    protected $fillable = ['report_id', 'section', 'user_id','date', 'time', 'case', 'summary', 'chronology', 'measure', 'conclusion'];

    // relation to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relation to attachments
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    // relation to report
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
    
    // generate slugs
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('title')
    //         ->saveSlugsTo('slug');
    // }

}
