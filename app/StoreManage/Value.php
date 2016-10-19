<?php

namespace App\StoreManage;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = [
        'property_id',
        'value',
        'price',
        'stock',
        'warning_stock'
    ];

    public function property()
    {
        return $this->belongsTo('App\StoreManage\Property');
    }
}
