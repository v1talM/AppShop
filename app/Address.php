<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'custom_address',
        'user_phone'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
