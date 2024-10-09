<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{


    public function run()
    {
        DB::table('post_categories')->insert([
            ['title' => 'Movies', 'slug' => Str::slug('Movies')],
            ['title' => 'Books', 'slug' => Str::slug('Books')],
            ['title' => 'Courses', 'slug' => Str::slug('Courses')],
            ['title' => 'Articles', 'slug' => Str::slug('Articles')],
            ['title' => 'Music Albums', 'slug' => Str::slug('Music Albums')],
            ['title' => 'Video Games', 'slug' => Str::slug('Video Games')],
            ['title' => 'TV Shows', 'slug' => Str::slug('TV Shows')],
            ['title' => 'Podcasts', 'slug' => Str::slug('Podcasts')],
            ['title' => 'Blogs', 'slug' => Str::slug('Blogs')],
            ['title' => 'Magazines', 'slug' => Str::slug('Magazines')],
            ['title' => 'Workshops/Seminars', 'slug' => Str::slug('Workshops/Seminars')],
        ]);
    }
}

    /**
     * Run the database seeds.
     */
   
