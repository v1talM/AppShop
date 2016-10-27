<?php

namespace App\Http\Controllers;

use App\Repositories\AddressRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class AddressController extends Controller
{
    protected $repository;

    /**
     * AddressController constructor.
     * @param $factory
     */
    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAddressByUserId(Request $request)
    {
        $user_id = $request->input('user_id');
        try{
            $address = $this->repository->getAddressByUserId($user_id);
        }catch (\Exception $e){
            return response()->json(['status' => 406 , 'message' => '获取收货地址失败']);
        }
        return response()->json(['status' => 200 , 'data' => $address , 'message' => '获取收货地址成功']);
    }

}
