<?php

namespace App\Http\Controllers;

use App\Repositories\ShopcartRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        $result = $this->repository->addGoods($input);
    }
}
