<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Contoh data dummy
         $comments = [
            [
                'post_id' => 1,
                'user_id' => 1,
                'comments_content' => 'contoh comment ke satu',
            ],
        ];
        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
