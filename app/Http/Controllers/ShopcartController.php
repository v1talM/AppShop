<?php

namespace App\Http\Controllers;

use App\Repositories\ShopcartRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class ShopcartController extends Controller
{
    protected $repository;
    protected $redis;
    /**
     * ShopcartController constructor.
     * @param $repository
     */
    public function __construct(ShopcartRepository $repository, \Redis $redis)
    {
        $this->repository = $repository;
        $this->redis = $redis;
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
            $this->redis->lpush($input['user_id'],$result);
        }catch (\Exception $e){
            return response()->json(['status' => 500, 'message' => '添加购物车失败']);
        }
        return response()->json(['status' => 200, 'message' => '添加购物车成功']);
    }
}
