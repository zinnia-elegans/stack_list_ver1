<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Comment::create([
                'user_id' => 1,
                'tweet_id' => 1,
                'text' => 'テストコメント!',
                'created_at' => now(),
                'updated_at' => now()
            ]);   
    }
}
