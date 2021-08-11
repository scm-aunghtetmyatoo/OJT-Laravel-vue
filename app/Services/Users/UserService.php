<?php

namespace App\Services\Users;

use Illuminate\Http\Request;
use App\Contracts\Dao\Users\UserDaoInterface;
use App\Contracts\Services\Users\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * The post dao instance.
     */
    private $userDao;

    /**
     * Constructor
     *
     * @param userDaoInterface $userDao
     * @return void
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * Go post lists function.
     *
     * @return void
     */
    public function getUserList()
    {
        return $this->userDao->getUserList();
    }

    public function show($id)
    {
        return $this->userDao->show($id);
    }

    public function store($request)
    {
        return $this->userDao->store($request);
    }

    public function edit($request, $id)
    {
        return $this->userDao->edit($request, $id);
    }

    public function editConfirm($request, $id)
    {
        return $this->userDao->editConfirm($request, $id);
    }

    public function update($request, $id)
    {
        return $this->userDao->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->userDao->destroy($id);
    }

    public function search($request)
    {
        return $this->userDao->search($request);
    }

}