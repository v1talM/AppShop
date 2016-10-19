<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/23 0023
 * Time: 下午 3:59
 */

namespace App\Factories;


use App\StoreManage\Category;
use App\StoreManage\Goods;
use App\StoreManage\Property;

class ShopManageFactory
{
    public $category;
    public $goods;
    public $property;

    /**
     * ShopManageFactory constructor.
     * @param $category
     * @param $goods
     * @param $property
     */
    public function __construct(Category $category, Goods $goods, Property $property)
    {
        $this->category = $category;
        $this->goods = $goods;
        $this->property = $property;
    }
}