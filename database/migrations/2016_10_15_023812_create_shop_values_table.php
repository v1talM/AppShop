<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned()->comment('对应属性ID');
            $table->string('value')->nullable()->comment('属性值');
            $table->string('price')->default(0)->comment('价格');
            $table->integer('stock')->default(0)->comment('库存');
            $table->integer('warning_stock')->unsigned()->default(0)->comment('库存报警数');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
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
        Schema::dropIfExists('shop_values');
    }
}
