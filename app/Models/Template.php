<?php

namespace App\Models;

// use Spatie\Sluggable\HasSlug;
// use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;
    // use HasSlug;

    
    protected $fillable = ['template_name', 'case', 'summary', 'chronology', 'measure', 'conclusion'];
    
    public function getFillables()
    {
        return $this->fillable;
    }
    protected function fillablesSentences()
    {
        $sentence = '';
        foreach ($this->fillable as $key => $value) {
            $sentence .= $this->$value;
        }
        return $sentence;
    }

    public function extractWords()
    {
        $pattern = '/\[.*?\]/';

        preg_match_all($pattern, $this->fillablesSentences(), $matches);
        return $matches[0];
        // return matches, but still in square brackets
    }
    
    public function getUniqueWords()
    {

        return array_unique($this->extractWords());
        // get unique matches, but still contains []
    }

    public function setupInputs()
    {
        $textTypeInputName = [];
        $replaceSquareBracketsPattern = '/\[|\]/';
        foreach ($this->getUniqueWords() as $match) {
            $textTypeInputName[] = preg_replace($replaceSquareBracketsPattern, '', $match);
        }

        // result, array with only word
        return $textTypeInputName;
        
    }

    // generate slugs
    // public function getSlugOptions() : SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('template_name')
    //         ->saveSlugsTo('slug');
    // }

    // public function getRouteKey()
	// {
    //     return $this->slug;
	// }

    // // Get the route key for the model.
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

}
