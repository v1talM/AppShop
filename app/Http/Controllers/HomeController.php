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

    public function category()
    {
        $categories = $this->homeRepository->getCategory()->toArray();
        $category_list = $this->homeRepository->getCategoryList($categories);
        return response()->json(['status' => 200, 'data' => $category_list]);
    }
}
