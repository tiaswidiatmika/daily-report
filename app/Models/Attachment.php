<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    
    protected $fillable = ['title','post_id', 'category', 'path', 'image_name'];

    public function post($id)
    {
        return $this->belongsTo(Post::class);
    }
}
