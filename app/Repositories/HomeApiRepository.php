<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/14 0014
 * Time: 下午 5:57
 */

namespace App\Repositories;


use App\Factories\ShopManageFactory;
use App\StoreManage\Goods;
use App\StoreManage\Property;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HomeApiRepository
{
    protected $factory;
    /**
     * HomeApiRepository constructor.
     * @param $goods
     */
    public function __construct(ShopManageFactory $factory)
    {
        $this->factory = $factory;
    }

    public function getHomepageThreeGoods()
    {
        $goods = $this->factory->goods
            ->with('property')
            ->where('is_new','=','1')
            ->where('created_at','>=',Carbon::now()->subWeek())
            ->take(3)
            ->get();
        $return = $this->getReturnArray($goods);

        return $return;
    }

    public function getHomepageFeatureGoods()
    {
        $goods = $this->factory->goods
            ->with('property')
            ->orderBy('click_count','desc')
            ->take(3)
            ->get();
        $return = $this->getReturnArray($goods);
        return $return;
    }

    public function getHomepageHotGoods()
    {
        $goods = $this->factory->goods
            ->with('property')
            ->orderBy('created_at','desc')
            ->take(10)
            ->get();
        $return = $this->getReturnArray($goods);
        return $return;
    }

    public function getReturnArray($goods)
    {
        $return = [];
        foreach ($goods as $key => $v){
            $return[$key]['goods_id'] = $v->id;
            $return[$key]['goods_thumb'] = $v->goods_thumb;
            $return[$key]['goods_name'] = $v->name;
            $return[$key]['goods_property'] = $this->getGoodsPrice($v->values);
        }
        return $return;
    }

    public function getGoodsPrice(Collection $value)
    {
        $return = [];
        foreach ($value as $key => $v){
            $return[$key]['value'] = $v->value;
            $return[$key]['price'] = $v->price;
        }
        //随机返回一个套餐的价格
        return $return[array_rand($return)];
    }

    //获取数据库中商品分类
    public function getCategory()
    {
        $categories = $this->factory->category->all();
        return $categories;
    }
    //递归商品分类信息排序输出
    public function getCategoryList($categories)
    {
        if(empty($categories)){
            return '';
        }
        $return = [];
        foreach ($categories as $key => $category){
            if($category['parent_id'] == 0){
                $category['sub_category'] = $this->getCategoriesByParentId($category['id']);
                $category['icon'] = env('APP_URL').'/images/'.$category['id'].'.png';
                $return[$key] = $category;
            }
        }
        return $return;
    }

    public function getCategoriesByParentId($parent_id)
    {
        $sub_category = $this->factory->category
            ->where('parent_id','=',$parent_id)
            ->select('name')
            ->get()
            ->toArray();
        $return = [];
        foreach ($sub_category as $value){
            array_push($return,$value['name']);
        }
        return $return;
    }
}