<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/27 0027
 * Time: 下午 4:00
 */

namespace App\Repositories;
use App\Factories\ShopManageFactory;

class AddressRepository
{
    protected $factory;

    public function __construct(ShopManageFactory $factory)
    {
        $this->factory = $factory;
    }

    public function getAddressByUserId($id)
    {
        $address = $this->factory->address->whereId(1)->get()->toArray();
        return $address;
    }
}