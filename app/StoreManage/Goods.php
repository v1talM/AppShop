<?php

namespace App\StoreManage;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $fillable = [
        'category_id',
        'goods_sn',
        'name',
        'click_count',
        'goods_number',
        'market_price',
        'shop_price',
        'promote_price',
        'warning_number',
        'goods_brief',
        'goods_desc',
        'goods_thumb',
        'goods_img',
        'original_img',
        'is_delete',
        'is_new',
        'give_integral'
    ];

    public function category()
    {
        return $this->belongsTo('App\StoreManage\Category','category_id','id');
    }

    public function property()
    {
        return $this->hasMany('App\StoreManage\Property');
    }

    public function values()
    {
        return $this->hasManyThrough('App\StoreManage\Value','App\StoreManage\Property');
    }
}
