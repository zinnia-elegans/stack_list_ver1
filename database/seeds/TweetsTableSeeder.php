<?php

use Illuminate\Database\Seeder;
use App\Models\Tweet;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::create([
            'user_id'    =>  1,
            'text'       => 'テスト投稿！',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
