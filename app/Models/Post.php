<?php

namespace App\Models;

// use Spatie\Sluggable\HasSlug;
// use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;
    // use HasSlug;

    // protected $fillable = ['template_name', 'case', 'summary', 'chronology', 'measure', 'conclusion'];
    protected $fillable = ['section', 'user_id','title', 'case', 'summary', 'chronology', 'measure', 'conclusion', 'tanggal_nesia'];

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
    
    // generate slugs
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('title')
    //         ->saveSlugsTo('slug');
    // }

}
