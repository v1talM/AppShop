<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/25 0025
 * Time: 下午 10:00
 */

namespace App\Repositories;


use App\Factories\ShopManageFactory;

class ShopcartRepository
{
    protected $factory;

    /**
     * ShopcartRepository constructor.
     * @param $shopcart
     */
    public function __construct(ShopManageFactory $factory)
    {
        $this->factory = $factory;
    }

    private function getGoodsInfoById($id)
    {
        $goods = $this->factory->goods
            ->whereId($id)
            ->with('property')
            ->get();
        return $goods;
    }

    public function addGoods($input)
    {
        $goods_info = $this->getGoodsInfoById($input['goods_id']);
        return response()->json(['data' => $goods_info]);
    }

}