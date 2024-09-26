<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'image', 'description', 'post_category_id', 'status', 'user_id', 'published_at'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            // Prevent slug from being updated when the title is updated
            ->doNotGenerateSlugsOnUpdate();
    }

    // public function postCategory()
    // {
    //     return $this->belongsTo(PostCategory::class)->withTrashed();
    // }

    public function category()
{
    return $this->belongsTo(PostCategory::class, 'post_category_id')->withTrashed();
}


    public function username()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function userupdate()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    // public static function getNewsCategoryLists($parentCategoriesList = null)
    // {
    //     $query = self::where('status', '=', '1')
    //         ->orderBy('title');

    //     $returnArray = $query->get()

    //         ->pluck('title', 'id')
    //         ->toArray();

    //     return $returnArray;
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->created_by = auth()->id();
        });

        static::updating(function ($post) {
            $post->updated_by = auth()->id();
        });

        static::deleting(function ($post) {
            $post->deleted_by = auth()->id();
            $post->save();
        });
    }
}
