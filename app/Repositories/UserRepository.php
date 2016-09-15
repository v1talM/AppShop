<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/15 0015
 * Time: 下午 8:06
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    protected $user;

    /**
     * UserRepository constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($input)
    {
        return $this->user->create($input);
    }
}