<?php

namespace App\StoreManage;

use Illuminate\Database\Eloquent\Model;

class ShopKeeper extends Model
{
    protected $fillable = [
      'email','password','nickname','true_name','is_auth','shop_name','avatar','shop_level'
    ];

    protected $hidden = [
      'is_auth','shop_level','password'
    ];
}
