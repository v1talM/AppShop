<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/25 0025
 * Time: 下午 10:00
 */

namespace App\Repositories;


use App\Factories\ShopManageFactory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

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

    /**
     * 根据商品id获取该商品的信息
     * @param $id
     * @return array
     */
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
            'goods_id' => $goods->id,
            'goods_name' => $goods->name,
            'goods_brief' => $goods->goods_brief,
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
        $shopcart = Redis::lrange($input['user_id'],0,-1);
        //$shopcart = Redis::lpop($input['user_id']);
        if(empty($shopcart)){
            $goods_info['goods_number'] = $input['goods_number'];
            $return[0] = $goods_info;
            return $return;
        }
        $array = $this->jsonToArray($shopcart);
        $return = $this->checkShopcart($array,$goods_info,$input['goods_number']);
        return $return;
    }

    private function jsonToArray($json)
    {
        $return = [];
        foreach ($json as $key => $val){
            $return[$key] = json_decode($val);
        }
        return $return;
    }

    private function checkShopcart($array,$goods,$goods_number)
    {

        $flag = 1;//1表示不在购物车内
        foreach ($array as $key => $value){
            if($value->goods_id == $goods['goods_id']){
                $value->goods_number += $goods_number;
                $flag = 0;
            }
        }
        if($flag){
            $goods['goods_number'] = $goods_number;
            $goods = json_decode(json_encode($goods));
            array_push($array,$goods);
        }
        return $array;
    }

    public function saveToRedis($array,$user_id)
    {
        try{
            $len = Redis::llen($user_id);
            for($i=0;$i<$len;$i++){
                Redis::rpop($user_id);
            }
            foreach ($array as $value){
                Redis::lpush($user_id,json_encode($value));
            }
        }catch (\Exception $e){
            return false;
        }
        return true;
    }
}