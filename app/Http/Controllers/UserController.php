<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Contracts\Services\Users\UserServiceInterface;


class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
        // $this->middleware('auth');  
    }
    
    public function index()
    {
        // if(Gate::allows('admin')) {
        // }
        $users = $this->userService->getUserList();

        return response()->json($users);
    }

    public function search(Request $request){
        $users = $this->userService->search($request);
    
        // Return the search view with the resluts compacted
        return view('users.index', compact('users'));
        
    }

    public function show(User $user)
    {
        // $user = $this->userService->show($user);

        // return view('users.show', compact('user'));
        return response()->json($user);

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
        $user = $this->userService->store($request);

        return response()->json([
            'message'=>'User Created Successfully!!',
            'user'=>$user
        ]);
    }

    public function edit(Request $request, $id)
    {
        $user = $this->userService->edit($request, $id);

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
        } else {
            $name = $user->name;
            $email = $user->email;
            $password = $user->password;
            $type = $user->type;
            $phone = $user->phone;
            $dob = $user->dob;
            $address = $user->address;
            $profile = $user->profile;
        }
        return view('users.edit', compact('user','name','email','password','type','phone','dob','address','profile'));
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


        $user = $this->userService->editconfirm($request, $id);
        
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

    public function update(Request $request, User $user)
    {
        $user = $this->userService->update($request, $user);

        return response()->json([
            'message'=>'User Updated Successfully!!',
            'user'=>$user
        ]);     
    }

    public function destroy(User $user)
    {
        // $user = $this->userService->destroy($user);
        $user->delete();


        return response()->json([
            'message'=>'User Deleted Successfully!!'
        ]);    
    }
}
