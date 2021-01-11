<?php

namespace App\Dao;

use App\User;
use App\Contracts\Dao\TestDaoInterface;

class TestDao implements TestDaoInterface
{
    public function getList()
    {
        return User::get();
    }
}
