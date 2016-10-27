<?php

use Illuminate\Database\Seeder;
use App\StoreManage\Category;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tea = Category::firstOrCreate([
            'name' => '精选茗茶',
            'description' => '精选茗茶',
            'keywords' => '精选茗茶',
            'parent_id' => 0,
            'measure_unit' => '-'
        ]);
        $oil = Category::firstOrCreate([
            'name' => '安全粮油',
            'description' => '安全粮油',
            'keywords' => '安全粮油',
            'parent_id' => 0,
            'measure_unit' => '-'
        ]);
        $safe = Category::firstOrCreate([
            'name' => '营养保健',
            'description' => '营养保健',
            'keywords' => '营养保健',
            'parent_id' => 0,
            'measure_unit' => '-'
        ]);
        $nature = Category::firstOrCreate([
            'name' => '天然干货',
            'description' => '天然干货',
            'keywords' => '天然干货',
            'parent_id' => 0,
            'measure_unit' => '-'
        ]);
        $food = Category::firstOrCreate([
            'name' => '生鲜食品',
            'description' => '生鲜食品',
            'keywords' => '生鲜食品',
            'parent_id' => 0,
            'measure_unit' => '-'
        ]);
        $fun = Category::firstOrCreate([
            'name' => '游 玩',
            'description' => '游 玩',
            'keywords' => '游 玩',
            'parent_id' => 0,
            'measure_unit' => '-'
        ]);
        $wine = Category::firstOrCreate([
            'name' => '酒 水',
            'description' => '酒 水',
            'keywords' => '酒 水',
            'parent_id' => 0,
            'measure_unit' => '-'
        ]);
    }
}
