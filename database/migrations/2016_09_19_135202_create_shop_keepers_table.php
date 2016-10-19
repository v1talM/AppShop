<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopKeepersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_keepers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->comment('登录邮箱');
            $table->string('password')->comment('登录密码');
            $table->string('nickname')->comment('昵称');
            $table->string('true_name')->comment('真实姓名');
            $table->enum('is_auth',['0','1'])->default('0')->comment('是否认证');
            $table->string('shop_name')->default('小店')->comment('店名');
            $table->string('avatar')->default('images/avatar.jpg');
            $table->enum('shop_level',['1','2','3','4','5','6','7','8','9'])->defatul('0')->comment('店铺等级');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_keepers');
    }
}
