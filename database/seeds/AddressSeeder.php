<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'user_id' => 1,
            'address_id' => '[1,1,1]',
            'custom_address' => '新康路四川农业大学学生公寓第三区22舍A303',
            'user_phone' => '18227590000'
        ]);
    }
}
