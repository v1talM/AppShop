<?php

namespace App\Http\Controllers\ShopManage;

use App\Repositories\ShopManageRepository;
use App\StoreManage\ShopKeeper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    protected $shopManageRepository;

    /**
     * ShopController constructor.
     * @param $shopManageRepository
     */
    public function __construct(ShopManageRepository $shopManageRepository)
    {
        $this->shopManageRepository = $shopManageRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = ShopKeeper::find(1);
        return view('shop.index',compact('user'));
    }

    /**
     * Show the form for creating a new category view.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCategory()
    {
        $categories = $this->shopManageRepository->getAllCategories()->toArray();
        $categories = $this->shopManageRepository->sortCategory($categories);

        return view('shop.commodity.create_category',compact('categories'));
    }

    public function createProperty()
    {
        $categories = $this->shopManageRepository->getCategoryWithProperties()->toArray();
        $categories = $this->shopManageRepository->sortCategory($categories);
        return view('shop.commodity.create_property',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:categories',
            'parent_id' => 'required',
            'measure_unit' => 'required'
        ]);
        if($validator->fails()){
            flash('您还没有填写完整的信息','error');
            return redirect()->back()->withInput();
        }
        try{
            $result = $this->shopManageRepository->createCategory($request->all());
        }catch (\Exception $e){
            flash('创建分类失败,请联系管理员','error');
            return redirect()->back()->withInput();
        }
        flash('创建分类成功!','success');
        return redirect()->route('category.create');
    }


    public function storeProperty(Request $request)
    {
        $input = [
            'category_id' => $request->input('sub_parent_id'),
            'name' => $request->input('name')
        ];
        $validator = Validator::make($input,[
            'name' => 'required',
            'category_id' => 'required',
        ]);
        if($validator->fails()){
            flash('您还没有填写完整的信息','error');
            return redirect()->back()->withInput();
        }
        try{
            $result = $this->shopManageRepository->createProperty($input);
        }catch (\Exception $e){
            flash('创建分类失败,请联系管理员','error');
            return redirect()->back()->withInput();
        }
        flash('创建分类成功!','success');
        return redirect()->route('property.create');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProperty()
    {
        $properties = $this->shopManageRepository->getAllProperties();
        return view('shop.commodity.show_property',compact('properties'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategory($id)
    {
        $category = $this->shopManageRepository->getCategoryById($id)->toArray();
        $category[0]['update'] = url('shop/category?id='.$id);
        return response()->json($category[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'parent_id' => 'required',
            'measure_unit' => 'required'
        ]);
        if($validator->fails()){
            flash('您还没有填写完整的信息','error');
            return redirect()->back()->withInput();
        }

        try{
            $result = $this->shopManageRepository->updateCategoryById($request->except('_token','_method'),$request->input('id'));
        }catch (\Exception $e){
            flash('修改分类信息失败,请联系管理员','error');
            return redirect()->back()->withInput();
        }
        flash('修改分类信息成功!','success');
        return redirect()->route('category.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory($id)
    {
        try{
            $this->shopManageRepository->destroyCategoryById($id);
        }catch (\Exception $e){
            flash('删除分类失败,请联系管理员','error');
            return redirect()->back();
        }
        flash('删除分类成功!','success');
        return redirect()->route('category.create');
    }

    public function destroyProperty($id)
    {
        try{
            $this->shopManageRepository->destroyPropertyById($id);
        }catch (\Exception $e){
            flash('删除属性失败,请联系管理员','error');
            return redirect()->back();
        }
        flash('删除属性成功!','success');
        return redirect()->route('property.list');
    }

    public function getSubCategory(Request $request)
    {
        $subCategories = $this->shopManageRepository->getCategoriesByParentId($request->input('id'));
        $category_name = [];
        foreach ($subCategories as $key => $subCategory)
        {
            $category_name[$key]['id'] = $subCategory['id'];
            $category_name[$key]['text'] = $subCategory['name'];
        }
        return response()->json($category_name);
    }
}
