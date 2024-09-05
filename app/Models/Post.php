<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['title', 'slug', 'image', 'description', 'post_category_id', 'status', 'user_id', 'published_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function username()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getNewsCategoryLists($parentCategoriesList = null)
    {
        $query = self::where('status', '=', '1')
            ->orderBy('title');

        $returnArray = $query->get()
            ->pluck('title', 'id')
            ->toArray();

        return $returnArray;
    }
}
