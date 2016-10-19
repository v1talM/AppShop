<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/11 0011
 * Time: 下午 9:07
 */

namespace App\Repositories;


use App\StoreManage\Category;
use App\StoreManage\Goods;
use App\StoreManage\Property;
use App\StoreManage\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class CommodityManageRepository
{
    public $goods;
    public $category;
    public $property;
    public $value;
    /**
     * CommodityManageRepository constructor.
     * @param $goods
     */
    public function __construct(Goods $goods,Category $category,Property $property,Value $value)
    {
        $this->goods = $goods;
        $this->category = $category;
        $this->property = $property;
        $this->value = $value;
    }

    public function getAllGoodsByCategoryId($id)
    {
        return $this->goods->where('category_id','=',$id)->with('property')->get();
    }

    public function getPropertiesByGoodsId($id)
    {
        return $this->goods->find($id)->property()->get();
    }

    public function getCategoryById($id)
    {
        return $this->category->find($id);
    }

    public function getGoodsById($id)
    {
        return $this->goods->with('property')->with('category')->find($id);
    }

    public function createCommodity(array $input)
    {
        $goods = $this->goods->create($input);
        //$goods->property()->attach($input['property_id']);
        return $goods;
    }

    public function createProperty(Request $request)
    {
        $input = [
            'goods_id' => $request->input('goods_id'),
            'name' => $request->input('property_name'),
        ];
        $property = $this->property
            ->firstOrCreate($input);
        foreach ($request->input('property_value') as $v){
            $value = $this->value->firstOrNew([
                'value' => $v,
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'warning_stock' => $request->input('warning_stock')
            ]);
            $property->values()->save($value);
        }
        return $property;
    }


    public function cropThumbImage(Request $request)
    {
        $directory = 'images/'.time();
        mkdir($directory);
        $file = $request->file('thumb');
        $original_img = $file->getClientOriginalName();
        $detail_filename = 'detail_'.time().'_'.$file->getClientOriginalName();
        $thumb_filename = 'thumb_'.time().'_'.$file->getClientOriginalName();
        $despath = $directory.'/';
        $file->move($despath,$file->getClientOriginalName());
        Image::make($despath.$file->getClientOriginalName())->fit(800)->save($despath.$detail_filename);
        Image::make($despath.$detail_filename)->fit(200)->save($despath.$thumb_filename);
        return [
            'original_img' => $despath.$original_img,
            'goods_img' => $despath.$detail_filename,
            'goods_thumb' => $despath.$thumb_filename
        ];
    }

    public function updateGoodsInfoById($input,$id)
    {
        $goods = $this->goods->find($id);
        $goods->update([
            'name' => $input['name'],
            'click_count' => $input['click_count'],
            'goods_number' => $input['goods_number'],
            'warning_number' => $input['warning_number'],
            'market_price' => $input['market_price'],
            'promote_price' => $input['promote_price'],
            'shop_price' => $input['shop_price'],
            'is_new' => $input['is_new'],
            'give_integral' => $input['give_integral'],
            'goods_brief' => $input['goods_brief'],
            'goods_desc' => $input['goods_desc'],
            'goods_thumb' => $input['goods_thumb'],
            'goods_img' => $input['goods_img'],
            'original_img' => $input['original_img']
        ]);
        $goods->property()->sync($input['property_id']);
        return $goods;
    }
}