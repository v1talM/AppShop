<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopcartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopcart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->comment('用户id');
            $table->integer('goods_id')->unsigned()->comment('商品id');
            $table->integer('goods_sn')->comment('商品编号取自于goods表');
            $table->integer('goods_number')->unsigned()->comment('商品数量');
            $table->string('goods_price')->comment('商品价格');
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
        Schema::dropIfExists('shopcart');
    }
}
