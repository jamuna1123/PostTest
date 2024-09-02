<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PostCategory extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'slug', 'image', 'parent_id', 'status'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

     public function parentCategory()
    {
        return $this->belongsTo(PostCategory::class, 'parent_id');
    }
}

