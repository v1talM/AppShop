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
        $id = 1;
        $address = $this->factory->address->whereId($id)->get()->toArray();
        return $address;
    }
}