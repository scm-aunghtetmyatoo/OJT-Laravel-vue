<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(4);

        return view('users.index',compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'profile' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('profile');
        $imageName = $imagePath->getClientOriginalName();

        $path = $request->file('profile')->storeAs('uploads', $imageName, 'public');


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->profile = $imageName;
        $user->save();

        return redirect()->route('users.index')->with('success','User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = $request->file('profile');
        $imageName = $imagePath->getClientOriginalName();

        $path = $request->file('profile')->storeAs('uploads', $imageName, 'public');

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->profile = $imageName;
        $user->save();

        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

         return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
