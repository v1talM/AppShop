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
            Redis::lpush($input['user_id'],$result);
        }catch (\Exception $e){
            return response()->json(['status' => 500, 'message' => '添加到购物车失败']);
        }
        return response()->json(['status' => 200, 'message' => '添加购物车成功']);
    }

    public function getShopcartByUserId(Request $request)
    {
        try{
            $user_id = $request->input('user_id');
            $shopcart_goods = Redis::lrange($user_id,0,-1);
        }catch (\Exception $e){
            return response()->json(['status' => 500, 'data'=>[],'message' => '获取数据失败']);
        }

        return response()->json(['status' => 200, 'data' => $shopcart_goods , 'message' => '获取数据成功']);
    }
}
