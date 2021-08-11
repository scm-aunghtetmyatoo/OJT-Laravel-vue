<?php

namespace App\Dao\Users;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\Users\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    /**
     * Go post list.
     *
     * @return void
     */
    public function getUserList()
    {
        $users = User::orderBy('id', 'desc')->paginate(config('constants.paginate.user'));

        return $users;
    }

    public function show($id)
    {
        $user = User::find($id);

        return $user;
    }

    public function store($request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->profile = $request->profile;
        $user->created_user_id = auth()->user()->id;
        $user->updated_user_id = auth()->user()->id;
        $user->save();

        return $user;
    }

    public function edit($request, $id)
    {
        $user = User::find($id);
        return $user;
    }

    public function editConfirm($request, $id)
    {
        $user = User::find($id);

        return $user;
    }

    public function update($request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->profile = $request->profile;
        $user->updated_user_id = auth()->user()->id;
        $user->save();

        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->deleted_user_id = Auth::user()->id;
        $user->save;

        $user->delete();

        return $user;
    }

    public function search($request)
    {
        // Get the search value from the request
        $search = $request->search;
    
        // Search in the title and descroption columns from the users table
        $users = User::query()
            ->where('name', 'like', "%{$search}%")
            ->paginate(2);

        return $users;
    }

  }