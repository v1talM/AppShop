<?php

namespace App\Http\Controllers;

use App\Repositories\HomeApiRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    protected $homeRepository;

    /**
     * HomeController constructor.
     * @param $homeRepository
     */
    public function __construct(HomeApiRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    /**
     * 获取app首页商品信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $qg_goods = $this->homeRepository->getHomepageThreeGoods();
        $feature_goods = $this->homeRepository->getHomepageFeatureGoods();
        $hot_goods = $this->homeRepository->getHomepageHotGoods();
        return response()->json(['status' => 200,'data' => [
            'qg_data' => $qg_goods,
            'feature_data' => $feature_goods,
            'hot_data' => $hot_goods
        ]]);
    }

    /**
     * 获取app分类菜单列表
     * @return $this
     */
    public function category()
    {
        $categories = $this->homeRepository->getCategory()->toArray();
        $category_list = $this->homeRepository->getCategoryList($categories);
        return response()->json(['status' => 200, 'data' => $category_list])->header('Access-Control-Allow-Origin','*');
    }

    /**
     * 根据商品id获取该商品详细信息
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsInfoById($id)
    {
        $goods = $this->homeRepository->getGoodsInfoById($id);
        return response()->json(['status' => 200,'data' => $goods]);
    }

    /**
     * 根据分类ID获取该分类下所有商品信息
     * @param $id
     */
    public function getCategoryGoods($id)
    {
        $goods = $this->homeRepository->getGoodsInfoByCategoryId($id);
        return response()->json(['status' => 200, 'data' => $goods]);
    }
}
