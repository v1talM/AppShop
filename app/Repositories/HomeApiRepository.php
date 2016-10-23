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


    /**
     * 返回商品 id,缩略图,名称,属性,简述。用于展示商品列表信息
     * @param $goods
     * @return array
     */
    public function getReturnArray($goods)
    {
        $return = [];
        foreach ($goods as $key => $v){
            $return[$key]['goods_id'] = $v->id;
            $return[$key]['goods_thumb'] = $v->goods_thumb;
            $return[$key]['goods_name'] = $v->name;
            $return[$key]['goods_property'] = $this->getGoodsPrice($v->values);
            $return[$key]['goods_brief'] = $v->goods_brief;

        }
        return $return;
    }

    /**
     * 获取商品价格以及属性值并返回
     * @param Collection $value
     * @return mixed
     */
    public function getGoodsPrice(Collection $value)
    {
        $return = [];
        foreach ($value as $key => $v){
            $return[$key]['value'] = $v->value;
            $return[$key]['price'] = $v->price;
        }
        //随机返回一个套餐的价格
        return $return;
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
            ->select('id','name')
            ->get()
            ->toArray();
        $return = $sub_category;
        return $return;
    }
<<<<<<< HEAD

    public function getGoodsInfoById($id)
    {
        $goods = $this->factory->goods
            ->where('id','=',$id)
            ->with('values')
            ->get();
        $return = $this->getGoodsDetailReturnArray($goods);
        return $return;
    }

    public function getGoodsDetailReturnArray($goods)
    {
        $return = [];
        foreach ($goods as $key => $v){
            $return[$key]['goods_id'] = $v->id;
            $return[$key]['goods_thumb'] = $v->goods_thumb;
            $return[$key]['goods_name'] = $v->name;
            $return[$key]['goods_property'] = $this->getGoodsPrice($v->values);
            $return[$key]['goods_desc'] = $v->goods_brief;
        }
        return $return;
    }
}
=======
}
>>>>>>> 4445e0ae96017c09617a9611176bae9ca25fe0ee
