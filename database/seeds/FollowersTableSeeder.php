<?php

use Illuminate\Database\Seeder;
use App\Models\Follower;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Follower::create([
            'following_id' => 1,
            'followed_id' => 1
        ]);
    }
}
