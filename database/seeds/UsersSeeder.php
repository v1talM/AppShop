<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'name' => 'vital',
            'email' => '373357042@qq.com',
            'password' => bcrypt('123456'),
            'avatar' => 'avatar.jpg',
            'score' => 0,
            'total_score' => 0,
            'level' => 1,
            'is_baned' => 0
        ]);
    }
}
