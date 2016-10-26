<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/25 0025
 * Time: 下午 10:00
 */

namespace App\Repositories;


use App\Factories\ShopManageFactory;
use Illuminate\Support\Collection;

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
            ->first();

        $goods = $this->getShopcartReturnArray($goods);
        return $goods;
    }

    private function getShopcartReturnArray($goods)
    {
        $return = [
            'goods_name' => $goods->name,
            'goods_brief' => $goods->brief,
            'goods_thumb' => $goods->goods_thumb,
            'give_integral' => $goods->give_integral,
            'goods_price' => $this->getGoodsPrice($goods->values)
        ];
        return $return;
    }

    private function getGoodsPrice(Collection $value)
    {
        $return = [];
        foreach ($value as $key => $v){
            $return = $v->price;
        }
        return $return;
    }
    public function addGoods($input)
    {
        $goods_info = $this->getGoodsInfoById($input['goods_id']);
        return response()->json(['data' => $goods_info]);
    }

}