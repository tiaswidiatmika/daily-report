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

    protected $fillable = ['report_id', 'section', 'user_id','date', 'time', 'title', 'case', 'summary', 'chronology', 'measure', 'conclusion', 'qrcode', 'is_in_report'];
    protected $with = ['attachments'];


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
