<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(config('constants.paginate.user'));

        return view('users.index',compact('users'));
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->search;
    
        // Search in the title and descroption columns from the posts table
        $users = User::query()
            ->where('name', 'like', "%{$search}%")
            ->paginate(2);
    
        // Return the search view with the resluts compacted
        return view('users.index', compact('users'));
        
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'profile' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $imagePath = $request->file('profile');
        $imageName = $imagePath->getClientOriginalName();

        $request->file('profile')->storeAs('uploads', $imageName, 'public');

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $type = $request->type;
        $phone = $request->phone;
        $dob = $request->dob;
        $address = $request->address;
        $profile = $imageName;

        return view('users.confirm',compact('name','email','password','password_confirmation','type','phone','dob','address','profile'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'profile' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);



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
