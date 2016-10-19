<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/11 0011
 * Time: 下午 8:30
 */

namespace App\Presenters;


use App\Repositories\ShopManageRepository;

class SidebarPresenter
{
    protected $repository;

    /**
     * sidebarPresenter constructor.
     * @param $repository
     */
    public function __construct(ShopManageRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getFirstGoodsSidebar()
    {
        $categories = $this->repository->getAllCategories();
        $return = "";
        foreach ($categories as $key => $category)
        {
            if($category->parent_id == 0)
            {
                $return .= "<li><a>$category->name<span class='fa fa-chevron-down'></span></a>";
                $return .= $this->getSubGoodsSidebar($category->id);
                $return .= "</li>";
            }
        }
        return $return;
    }

    public function getSubGoodsSidebar($parent_id)
    {
        $return = "<ul class='nav child_menu'>";
        $categories = $this->repository->getCategoriesByParentId($parent_id);
        foreach ($categories as $category)
        {
            $return .="<li><a href='".route('goods.list',['id'=>$category->id])."'>$category->name</a></li>";
        }
        $return .= "</ul>";
        return $return;
    }
}