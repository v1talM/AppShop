<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/23 0023
 * Time: 下午 4:02
 */

namespace App\Repositories;


use App\Factories\ShopManageFactory;

class ShopManageRepository
{
    public $shopManageFactory;

    /**
     * ShopManageRepository constructor.
     * @param $shopManageFactory
     */
    public function __construct(ShopManageFactory $shopManageFactory)
    {
        $this->shopManageFactory = $shopManageFactory;
    }

    public function getAllCategories()
    {
        return $this->shopManageFactory->category->all();
    }

    public function getAllProperties()
    {
        return $this->shopManageFactory->property->all();
    }

    public function getCategoriesByParentId($id)
    {
        return $this->shopManageFactory->category->where('parent_id',$id)->get();

    }

    public function getCategoryWithProperties()
    {
        return $this->shopManageFactory->category->with('properties')->get();
    }

    public function createCategory($input)
    {
        return $this->shopManageFactory->category->create($input);
    }

    public function createProperty($input)
    {
        return $this->shopManageFactory->property->create($input);
    }

    public function createGoods($input)
    {
        return $this->shopManageFactory->goods->create($input);
    }

    public function getCategoryById($id)
    {
        return $this->shopManageFactory->category->whereId($id)->get();
    }


    public function updateCategoryById($input,$id)
    {
        return $this->shopManageFactory->category->whereId($id)->update($input);
    }

    public function destroyCategoryById($id)
    {
        return $this->shopManageFactory->category->whereId($id)->delete();
    }

    public function destroyPropertyById($id)
    {
        return $this->shopManageFactory->property->whereId($id)->delete();
    }

    public function sortCategory($categories,$pid=0)
    {

        $arr = [];
        if (empty($categories)) {
            return '';
        }
        foreach ($categories as $key => $v) {
            if ($v['parent_id'] == $pid) {
                $arr[$key] = $v;
                $arr[$key]['child'] = self::sortCategory($categories,$v['id']);
            }
        }

        return $arr;
    }
}