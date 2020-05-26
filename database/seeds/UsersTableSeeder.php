<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::create([
                'screen_name'    => 'test1', 
                'name'           => 'test1', 
                'profile_image'  => 'https://placehold.jp/50x50.png',
                'email'          => 'test1@test.com',
                'password'       => Hash::make('111111'),
                'remember_token' => str_random(10),
                'created_at'     => now(),
                'updated_at'     => now()
            ]);
    }
}
