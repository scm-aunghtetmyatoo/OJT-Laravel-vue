<?php

namespace App\Contracts\Dao\Posts;
use Illuminate\Http\Request;

interface PostDaoInterface 
{
    public function getPostList($request);

    public function store($request);

    public function edit($request, $id);

    public function editConfirm($request, $id);

    public function update($request, $id);

    public function destroy($id);

    public function search($request);
}