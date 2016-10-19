<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->comment('所属分类ID');
            $table->integer('goods_sn')->comment('商品唯一编号');
            $table->string('name')->comment('商品名称');
            $table->integer('click_count')->unsigned()->default(0)->comment('商品点击数量');
//            $table->integer('goods_number')->unsigned()->default(0)->comment('商品库存量');
//            $table->string('market_price')->comment('商品市场价');
//            $table->string('shop_price')->comment('本店销售价');
//            $table->string('promote_price')->comment('促销价');
//            $table->integer('warning_number')->unsigned()->default(1)->comment('商品库存报警数');
            $table->string('goods_brief')->comment('商品简短描述');
            $table->text('goods_desc')->comment('商品详细描述');
            $table->string('goods_thumb')->comment('商品缩略图');
            $table->string('goods_img')->comment('商品详情图');
            $table->string('original_img')->comment('商品原始图');
            $table->enum('is_delete',[0,1])->default(0)->comment('商品是否删除,0否1是');
            $table->enum('is_new',[0,1])->default(0)->comment('商品是否新品,0否1是');
            $table->integer('give_integral')->default(0)->comment('商品购买赠送的积分');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('goods');
    }
}
