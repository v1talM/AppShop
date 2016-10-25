<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    public function oauth(Request $request)
    {
        $http = new Client();
        $user = [
            'email' => $request->input('username'),
            'password' => $request->input('password')
        ];
        //获取api认证
        try {
            $response = $http->post('http://shop.dev/oauth/token',[
                'form_params' =>[
                    'grant_type' => 'password',
                    'client_id' => 7,
                    'client_secret' => 'ApEySDWQV8r2HTPNSj7EfJ8Ov04FEGywbIpdnHhf',
                    'username' => $user['email'],
                    'password' => $user['password'],
                    'scope' => '*'
                ]
            ]);
        }catch (\Exception $e){
            return response()->json([
                'token' => '',
                'status' => 403,
                'message' => '用户名和密码不匹配'
            ]);
        }

        if (! Auth::attempt(['email' => $user['email'], 'password' => $user['password']], true)) {
            //账号密码不匹配
            return response()->json([
                'token' => '',
                'status' => 403,
                'message' => '用户名和密码不匹配'
            ]);
        }

        $access_token =  Arr::get(json_decode((string) $response->getBody(),true),'access_token');
        return response()->json([
            'token' => $access_token,
            'user' => auth()->user(),
            'message' => '登录成功',
            'status' => 200
        ]);
    }

}
