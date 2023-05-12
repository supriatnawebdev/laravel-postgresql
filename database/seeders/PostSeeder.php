<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Contoh data dummy
         $posts = [
            [
                'title' => 'contoh satu',
                'news_content' => 'contoh ke satu masbro',
                'author' => 1,
            ],
        ];
        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
