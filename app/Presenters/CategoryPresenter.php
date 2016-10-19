<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/23 0023
 * Time: 下午 4:21
 */

namespace App\Presenters;


class CategoryPresenter
{
    public function getCategory($categories)
    {
        if ($categories) {
            $option = '<option value="0">顶级菜单</option>';
            foreach ($categories as $v) {
                $option .= '<option value="'.$v['id'].'">'.$v['name'].'</option>';
            }
            return $option;
        }
        return '<option value="0">顶级菜单</option>';
    }
    public function getAllCategoriesList($categories)
    {

        if (empty($categories))
        {
            return '暂无任何分类~';
        }

        $list = '';
        foreach ($categories as $category)
        {
            $list .= $this->getNestableCategory($category);
        }

        return $list;
    }


    public function getNestableCategory($category)
    {
        if($category['child'])
        {
            return $this->getHandleCategory($category['id'],$category['name'],$category['child']);
        }
        if($category['parent_id'] ==0)
        {
            return '<li class="dd-item dd3-item" data-id="'.$category['id'].'"><div class="dd-handle dd3-handle"> </div><div class="dd3-content">'.$category['name'].$this->getActiveButtons($category['id']).'</div></li>';
        }
        return '<li class="dd-item dd3-item" data-id="'.$category['id'].'"><div class="dd-handle dd3-handle"> </div><div class="dd3-content"> '.$category['name'].$this->getActiveButtons($category['id']).'</div></li>';
    }

    public function getHandleCategory($category_id, $category_name, $category_child)
    {
        $handle = '<li class="dd-item dd3-item" data-id="'.$category_id.'"><div class="dd-handle dd3-handle"> </div><div class="dd3-content">'.$category_name.$this->getActiveButtons($category_id).'</div><ol class="dd-list">';
        if ($category_child)
        {
            foreach ($category_child as $v)
            {
                $handle .= $this->getNestableCategory($v);
            }
        }
        $handle .= '</ol></li>';
        return $handle;
    }

    public function getActiveButtons($id)
    {
        $action = '<div class="pull-right action-buttons">
                        <a href="javascript:;" data-pid="'.$id.'" class="btn-xs createMenu" data-toggle="tooltip"data-original-title="添加"  data-placement="top">
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="javascript:;" data-href="'.url('shop/category/'.$id.'/edit').'" class="btn-xs editMenu" data-toggle="tooltip"data-original-title="修改"  data-placement="top">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:;" class="btn-xs destroyMenu" data-id="'.$id.'" data-original-title="删除"data-toggle="tooltip"  data-placement="top">
                            <i class="fa fa-trash"></i>
                            <form action="'.url('shop/category',[$id]).'" method="POST" name="delete_item'.$id.'" style="display:none">
                            <input type="hidden"name="_method" value="delete">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            </form>
                        </a>
                    </div>';
        return $action;
    }

    public function getParentCategories($categories)
    {
        if(empty($categories))
        {
            return '';
        }
        $option = '<li><option value="">请选择分类</option></li>';
        foreach ($categories as $key => $category)
        {
            if($category['parent_id'] ==0 )
            {
                $option .= '<li><option value="'.$category['id'].'">'.$category['name'].'</option></li>';
            }
        }
        return $option;
    }



    public function getCategoryProperties($categories)
    {
        if(empty($categories))
        {
            return '暂无任何分类属性';
        }
        $list = '';
        foreach ($categories as $category)
        {
            $list .= $this->getNestableCategoryPro($category);
        }
        return $list;
    }

    public function getNestableCategoryPro($category)
    {
        if($category['child'])
        {
            return $this->getHandleCategoryPro($category['id'],$category['name'],$category['child']);
        }

        $list = '<li class="dd-item dd3-item" data-id="'.$category['id'].'"><div class="dd-handle dd3-handle"> </div><div class="dd3-content">'.$category['name'].'</div></li>';
        return $list;
    }

    public function getHandleCategoryPro($category_id,$category_name,$category_child)
    {
        $handle = '<li class="dd-item dd3-item" data-id="'.$category_id.'"><div class="dd-handle dd3-handle"> </div><div class="dd3-content">'.$category_name.'</div><ol class="dd-list">';
        if ($category_child)
        {
            foreach ($category_child as $v)
            {
                $handle .= $this->getNestableCategoryPro($v);
            }
        }
        $handle .= '</ol></li>';
        return $handle;
    }

    public function getActiveButtonsPro($id)
    {
        $action = '<div class="pull-right action-buttons">
                        <a href="javascript:;" data-pid="'.$id.'" class="btn-xs createMenu" data-toggle="tooltip"data-original-title="添加"  data-placement="top">
                            <i class="fa fa-plus"></i>
                        </a>
                        
                    </div>';
        return $action;
    }
}