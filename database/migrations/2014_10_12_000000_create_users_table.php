<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('昵称');
            $table->string('email')->unique()->comment('登录邮箱');
            $table->string('password');
            $table->string('avatar')->comment('用户头像');
            $table->integer('score')->default('0')->comment('积分');
            $table->integer('total_score')->default('0')->comment('积分总计');
            $table->enum('level',['1','2','3','4','5'])->default('1')->comment('会员等级');
            $table->enum('is_banned',['1','0'])->default('0')->comment('是否可用');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
