<?php

namespace App\Http\Controllers\ShopManage;

use App\Repositories\CommodityManageRepository;
use App\StoreManage\PropertyValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommodityController extends Controller
{
   protected $commodityRepository;


    /**
     * CommodityController constructor.
     * @param $commodityManageRepository
     */
    public function __construct(CommodityManageRepository $commodityManageRepository)
    {
        $this->commodityRepository = $commodityManageRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        $goods = $this->commodityRepository->getAllGoodsByCategoryId($category_id);

        return view('shop.commodity.show_commodity',compact('goods','category_id'));
    }

    public function create($category_id)
    {
        $category = $this->commodityRepository->getCategoryById($category_id);

        return view('shop.commodity.create_commodity',compact('category'));
    }

    public function createProperty($id)
    {
        $goods = $this->commodityRepository->getGoodsById($id);

        return view('shop.commodity.create_property',compact('goods','property_list'));
    }

    public function store(Request $request)
    {

        $input['category_id'] = $request->input('category_id');//所属分类
        $input['goods_sn'] = time();//商品编号
        $input['name'] = $request->input('name');//商品名称
        $input['click_count'] = $request->input('click_count');//商品点击量
//        $input['warning_number'] = $request->input('warning_number');//库存报警数
//        $input['market_price'] = $request->input('shop_price');//市场价
//        $input['promote_price'] = $request->input('shop_price');//促销价
//        $input['shop_price'] = $request->input('shop_price');//商品销售价
        $input['is_new'] = $request->input('is_new');//是否新品
        $input['is_delete'] = $request->input('is_delete');//是否上架
        $input['give_integral'] = $request->input('give_integral');//赠送积分
        $input['goods_brief'] = $request->input('goods_brief');//商品简短描述
        $input['goods_desc'] = $request->input('goods_desc');//商品详细描述
        $input['property_id'] = $request->input('properties');//商品属性数组

        //表单验证
        $messages = [
            'required' => '您还没有填写 :attribute 字段',
            'numeric' => ':attribute 字段的值不符合规范',
            'integer' => ':attribute 字段的值不符合规范'
        ];
        $validator = Validator::make($input,[
            'category_id' => 'required|integer',
            'name' => 'required',
            'click_count' => 'required|integer',
            'is_new' => 'required|integer',
        ],$messages);
        if($validator->fails()){
            flash($validator->errors(),'error');
            return redirect()->back()->withInput();
        }
        $images = $this->commodityRepository->cropThumbImage($request);
        $input['goods_thumb'] = $images['goods_thumb'];//商品缩略图
        $input['goods_img'] = $images['goods_img'];//商品详细图
        $input['original_img'] = $images['original_img'];//商品原图
        try{
            $this->commodityRepository->createCommodity($input);
        }catch (\Exception $e){
            flash('添加商品失败,请联系管理员','error');
            return redirect()->back()->withInput();
        }
        flash('添加商品成功!','success');
        return redirect()->route('goods.list',['id' => $input['category_id']]);
    }

    public function storeProperty(Request $request)
    {
        try{
            $this->commodityRepository->createProperty($request);
        }catch (\Exception $e){
            flash('添加属性失败,请联系管理员','error');
            return redirect()->back();
        }
        flash('添加属性成功!','success');
        return redirect()->back();
    }

    public function edit($id)
    {
        $goods = $this->commodityRepository->getGoodsById($id);

        return view('shop.commodity.edit_commodity',compact('goods'));
    }

    public function update(Request $request,$id)
    {
        $input['category_id'] = $request->input('category_id');//所属分类
        $input['name'] = $request->input('name');//商品名称
        $input['click_count'] = $request->input('click_count');//商品点击量
        $input['goods_number'] = $request->input('goods_number');//商品库存量
        $input['warning_number'] = $request->input('warning_number');//库存报警数
        $input['market_price'] = $request->input('shop_price');//市场价
        $input['promote_price'] = $request->input('shop_price');//促销价
        $input['shop_price'] = $request->input('shop_price');//商品销售价
        $input['is_new'] = $request->input('is_new');//是否新品
        $input['give_integral'] = $request->input('give_integral');//赠送积分
        $input['goods_brief'] = $request->input('goods_brief');//商品简短描述
        $input['goods_desc'] = $request->input('goods_desc');//商品详细描述
        $input['property_id'] = $request->input('properties');//商品属性数组
        $images = [];
        if($request->hasFile('thumb')){
            $images = $this->commodityRepository->cropThumbImage($request);
            $input['goods_thumb'] = $images['goods_thumb'];//商品缩略图
            $input['goods_img'] = $images['goods_img'];//商品详细图
            $input['original_img'] = $images['original_img'];//商品原图
        }else{
            $input['goods_thumb'] = $this->commodityRepository->getGoodsById($id)->goods_thumb;//商品缩略图
            $input['goods_img'] = $this->commodityRepository->getGoodsById($id)->goods_img;//商品详细图
            $input['original_img'] = $this->commodityRepository->getGoodsById($id)->original_img;//商品原图
        }
        try{
            $this->commodityRepository->updateGoodsInfoById($input,$id);
        }catch (\Exception $e){
            flash('修改商品信息失败,请联系管理员','error');
            return redirect()->back()->withInput();
        }
        flash('修改商品信息成功!','success');
        return redirect()->route('goods.list',['id' => $input['category_id']]);
    }

}
