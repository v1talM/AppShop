<?php

use Illuminate\Database\Seeder;
use App\StoreManage\ShopKeeper;

class ShopManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShopKeeper::create([
            'email' => 'vital@shop.com',
            'password' => bcrypt('123456'),
            'nickname' => 'vital',
            'true_name' => '牟秋宇',
            'is_auth' => '1',
            'shop_name' => 'vital的杂货铺',
            'shop_level' => '1'
        ]);
    }
}
