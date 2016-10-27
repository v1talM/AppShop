<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ShopManagerSeeder::class);
        $this->call(ShopCategorySeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(AddressSeeder::class);
    }
}
