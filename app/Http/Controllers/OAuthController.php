<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    protected $http;

    /**
     * OAuthController constructor.
     * @param $http
     */
    public function __construct(Client $http)
    {
        $this->http = $http;
    }


    public function oauth(Request $request)
    {
        $response = $this->http->post('http://119.29.5.221/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => 9,
                //本地
                //'client_secret' => 'uNnM7S2dk7Et1Fhbld8t0pkTJNucH85qxUlQK2s3',
                //服务器上
                'client_secret' => 'W1GsIEpXqRbYn2ZrcT8hsQt0rCYFhR8lwPagR5Uf',
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'scope' => '',
            ],
        ]);
        //return json_decode((string) $response->getBody(), true);
        $accessToken =  Arr::get(json_decode((string) $response->getBody(), true),'access_token');
        return response()->json(['status' => 200 , 'accessToken' => $accessToken]);

    }

    public function getUserByToken(Request $request)
    {
        return json_decode((string) $request->user(), true);
    }
}
