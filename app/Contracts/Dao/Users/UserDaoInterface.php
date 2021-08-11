<?php

namespace App\Contracts\Dao\Users;
use Illuminate\Http\Request;

interface UserDaoInterface 
{
    public function getUserList();

    public function show($id);

    public function store($request);

    public function edit($request, $id);

    public function editConfirm($request, $id);

    public function update($request, $id);

    public function destroy($id);

    public function search($request);
}