<?php

namespace App\Http\Controllers;

use App\Repositories\HomeApiRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    protected $repository;

    /**
     * IndexController constructor.
     * @param $repository
     */
    public function __construct(HomeApiRepository $repository)
    {
        $this->repository = $repository;
    }

    public function home()
    {
        $qg_goods = $this->repository->getHomepageThreeGoods();
        $feature_goods = $this->repository->getHomepageFeatureGoods();
        $hot_goods = $this->repository->getHomepageHotGoods();
        return response()->json([
            'qg_data' => $qg_goods,
            'feature_data' => $feature_goods,
            'hot_data' => $hot_goods
        ]);
    }

    public function category()
    {
        $category = $this->repository->getCategory();
        $category_list = $this->repository->getCategoryList($category);
        return response()->json(['data' => $category_list]);
    }

    public function getGoodsInfoById($id)
    {
        $goods = $this->repository->getGoodsInfoById($id);
        return response()->json(['status' => 200, 'data' => $goods]);
    }

    public function getCategoryGoods($id)
    {
        $goods = $this->repository->getGoodsInfoByCategoryId($id);
        return response()->json(['status' => 200, 'data' => $goods]);
    }


}
