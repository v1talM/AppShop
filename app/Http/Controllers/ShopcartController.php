<?php

namespace App\Http\Controllers;

use App\Repositories\ShopcartRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redis;

class ShopcartController extends Controller
{
    protected $repository;
    /**
     * ShopcartController constructor.
     * @param $repository
     */
    public function __construct(ShopcartRepository $repository)
    {
        $this->repository = $repository;
    }


    public function create(Request $request)
    {
        $input = [
            'user_id' => $request->input('user_id'),
            'goods_id' => $request->input('goods_id'),
            'goods_number' => $request->input('goods_number'),
        ];
        try{
            $result = $this->repository->addGoods($input);
            //购物车商品存入redis

            $this->repository->saveToRedis($result,$input['user_id']);

        }catch (\Exception $e){
            return response()->json(['status' => 500, 'message' => '添加到购物车失败']);
        }
        return response()->json(['status' => 200, 'message' => '添加购物车成功']);
    }

    public function getShopcartByUserId(Request $request)
    {
        $return = [];
        try{
            $user_id = $request->input('user_id');
            $shopcart_goods = Redis::lrange($user_id,0,-1);
            foreach ($shopcart_goods as $key => $val){
                $return[$key]=json_decode($val);
            }

        }catch (\Exception $e){
            return response()->json(['status' => 500, 'data'=>[],'message' => '获取数据失败']);
        }
        dd($return);
        return response()->json(['status' => 200, 'data' => $shopcart_goods , 'message' => '获取数据成功']);
    }
}
