<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;



class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        if(Gate::allows('admin')) {
            $users = User::orderBy('id', 'desc')->paginate(config('constants.paginate.user'));

            return view('users.index',compact('users'));
        }
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

    public function create(Request $request)
    {
        if($request->hasFile('profile')) {
            $imagePath = $request->file('profile');
            $imageName = $imagePath->getClientOriginalName();

            $request->file('profile')->storeAs('uploads', $imageName, 'public');
            $profile = $imageName;
        } else {
            $profile = $request->profile;
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $type = $request->type;
        $phone = $request->phone;
        $dob = $request->dob;
        $address = $request->address;

        return view('users.create', compact('name','email','password','password_confirmation','type','phone','dob','address','profile'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required'],
            'phone' => ['required'],
            'dob' => ['required'],
            'address' => ['required'],
            'profile' => ['required','mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if($request->hasFile('profile')) {
            $imagePath = $request->file('profile');
            $imageName = $imagePath->getClientOriginalName();

            $request->file('profile')->storeAs('uploads', $imageName, 'public');
            $profile = $imageName;
        } else {
            $profile = $request->profile;
        }
        

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $type = $request->type;
        $phone = $request->phone;
        $dob = $request->dob;
        $address = $request->address;

        return view('users.confirm',compact('name','email','password','password_confirmation','type','phone','dob','address','profile'));
    }
    
    public function store(Request $request)
    {
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

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if(count($request->all()) > 0) {
            if($request->hasFile('profile')) {
                $imagePath = $request->file('profile');
                $imageName = $imagePath->getClientOriginalName();
    
                $request->file('profile')->storeAs('uploads', $imageName, 'public');
                $profile = $imageName;
            } else {
                $profile = $request->profile;
            }

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $type = $request->type;
            $phone = $request->phone;
            $dob = $request->dob;
            $address = $request->address;
            return view('users.edit', compact('user','name','email','password','type','phone','dob','address','profile'));
        } else {
            $name = $user->name;
            $email = $user->email;
            $password = $user->password;
            $type = $user->type;
            $phone = $user->phone;
            $dob = $user->dob;
            $address = $user->address;
            $profile = $user->profile;
            return view('users.edit', compact('user','name','email','password','type','phone','dob','address','profile'));
        }
    }

    public function editconfirm(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$id,
            'type' => ['required'],
            'phone' => ['required'],
            'dob' => ['required'],
            'address' => ['required'],
            'profile' => ['mimes:jpeg,png,jpg,gif,svg'],
        ]);


        $user = User::find($id);
        
        if($request->hasFile('profile')) {
            $imagePath = $request->file('profile');
            $imageName = $imagePath->getClientOriginalName();

            $request->file('profile')->storeAs('uploads', $imageName, 'public');
            $profile = $imageName;
        } else {
            $profile = $user->profile;
        }
 
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $type = $request->type;
        $phone = $request->phone;
        $dob = $request->dob;
        $address = $request->address;
        
        return view('users.editconfirm',compact('user','name','email','password','type','phone','dob','address','profile'));
    }

    public function update(Request $request, $id)
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
