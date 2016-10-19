<?php

namespace App\StoreManage;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
      'name','description','parent_id','measure_unit','keywords'
    ];

    public function properties()
    {
        return $this->hasMany('App\StoreManage\Property');
    }
}
