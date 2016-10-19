<?php

namespace App\StoreManage;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'goods_id','name'
    ];


    public function goods()
    {
        return $this->belongsTo('App\StoreManage\Goods');
    }

    public function values()
    {
        return $this->hasMany('App\StoreManage\Value');
    }
}
