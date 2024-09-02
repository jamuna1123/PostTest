<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PostCategory extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'slug', 'image','description','parent_id', 'status'];

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

//  public static function getNewsCategoryLists($parentCategoriesList= null)
//     {
//         $query = self::where('status', '=', '1')
//             ->orderBy('title');

//         $returnArray = $query->get()
//             ->pluck('title', 'parent_id')
//             ->toArray();

//         return $returnArray;
//     }

    public static function getNewsCategoryLists()
{
    return self::where('status', '1')
        ->orderBy('title')
        ->get(); // Return the collection of categories
}


}

