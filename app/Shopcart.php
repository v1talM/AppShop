<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopcart extends Model
{
    protected $fillable = [
        'user_id','goods_id','goods_sn','goods_number','goods_price'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
