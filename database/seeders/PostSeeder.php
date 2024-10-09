<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class PostSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'The Dark Knight Review',
                'content' => 'A detailed review of the movie The Dark Knight.',
                'category_id' => 1 // Movies
            ],
            [
                'title' => 'Top 10 Must-Read Fiction Books',
                'content' => 'A curated list of the best fiction books everyone should read.',
                'category_id' => 2 // Books
            ],
            [
                'title' => 'Introduction to Computer Science',
                'content' => 'An overview of essential concepts in computer science.',
                'category_id' => 3 // Courses
            ],
            [
                'title' => 'How AI is Changing Healthcare',
                'content' => 'Exploring the impact of artificial intelligence in the healthcare industry.',
                'category_id' => 4 // Articles
            ],
            [
                'title' => 'Abbey Road: The Beatles’ Legacy',
                'content' => 'Analyzing the influence of the Beatles’ album Abbey Road on modern music.',
                'category_id' => 5 // Music Albums
            ],
            [
                'title' => 'Breath of the Wild: A Game-Changer',
                'content' => 'Why The Legend of Zelda: Breath of the Wild redefined open-world games.',
                'category_id' => 6 // Video Games
            ],
            [
                'title' => 'Breaking Bad: A Character Study',
                'content' => 'In-depth analysis of the characters in Breaking Bad.',
                'category_id' => 7 // TV Shows
            ],
            [
                'title' => 'Serial: The True Crime Podcast Phenomenon',
                'content' => 'How Serial captivated millions with its storytelling.',
                'category_id' => 8 // Podcasts
            ],
            [
                'title' => 'How to Travel on a Budget',
                'content' => 'Tips and tricks for traveling the world without breaking the bank.',
                'category_id' => 9 // Blogs
            ],
            [
                'title' => 'Climate Change: The Science Behind the Headlines',
                'content' => 'Understanding the science driving climate change discussions.',
                'category_id' => 10 // Magazines
            ],
            [
                'title' => 'Mastering Digital Marketing',
                'content' => 'A comprehensive workshop on how to improve your digital marketing skills.',
                'category_id' => 11 // Workshops/Seminars
            ],
        ]);
    }
}


