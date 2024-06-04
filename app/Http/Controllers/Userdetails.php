<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class Userdetails extends Controller
{
    public function index()
 {
    $userdetail = User::all();
    if($userdetail->count() > 0)
    {
        return response()->json([
            'status' => 200,
            'userdetail' => $userdetail
        ],200);
    }
    else{
        return response()->json([
            'status' => 401,
            'userdetail' => 'user not found'],401);
        }
  }
  public function selecteduser($id)
  {
    $userdetailfind = User::find($id);
    if($userdetailfind)
    {
        return response()->json([
            'status' => 200,
            'userfind' => $userdetailfind
        ],200);
    }
    else
    {
        return response()->json([
            'status' => 404,
            'userfind' => 'user not exist'],404);
    }
  }

  public function Register(Request $request)
  {
     $validator = validator::make($request->all(),[
        'name' => ['required',Rule::unique('users'),'string','max:20'],
        'email' => ['required','email','max:20',Rule::unique('users')],
        'password' => ['required',Password::min(8),Password::min(8)->letters(),
        Password::min(8)->mixedCase(),Password::min(8)->symbols(),Password::min(8)->numbers(),],
     ]);
     if($validator->fails())
     {
        return response()->json([
         'status' => 422,
         'errors' => $validator->messages()],422);
     }
     else{
        $userdetail = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,  
        ]);
        if($userdetail)
        {
            return response()->json([
                'status' => 200,
                'message' => 'User Registered successfully'
            ],200);
        }
     }
  }
  
  public function Login(Request $request)
  {
    $validator = validator::make($request->all(),[

    'email' => ['required','email','max:20',Rule::unique('users')],
    'password' => ['required',Password::min(8),Password::min(8)->letters(),
    Password::min(8)->mixedCase(),Password::min(8)->symbols(),Password::min(8)->numbers(),],]);
    
    $credentials = $request->only('email','password');
    if(Auth::attempt($credentials))
    {
        return response()->json([
            'status' => 200,
            'message' => 'credentials are Valid...'
        ],200);
    }
    else
    {
        return response()->json([
            'status' => 500,
            'message' => 'username or password incorrect!!'
        ],200);
    }

  }

  public function Edit($id)
  {
    $userdetailedit = User::find($id);
    if($userdetailedit)
    {
        return response()->json([
            'status' => 200,
            'userfindedit' => $userdetailedit
        ],200);
    }
    else
    {
        return response()->json([
            'status' => 404,
            'userfindedit' => 'user not exist'],404);
    }
  }

  public function Update(Request $request, int $id)
  {

    $validator = validator::make($request->all(),[
        'name' => ['required','string','max:30'],
        'email' => ['required','email'],
        'password' => ['required',Password::min(8),Password::min(8)->letters(),
        Password::min(8)->mixedCase(),Password::min(8)->symbols(),Password::min(8)->numbers(),],
     ]);
     if($validator->fails())
     {
        return response()->json([
         'status' => 422,
         'errors' => $validator->messages()],422);
     }
     else{
        $userdetail = User::find($id);
        if($userdetail)
        {
            $userdetail->Update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,  
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'User Updated successfully'
            ],200);
        }else
        {
            return response()->json([
                'status' => 404,
                'message' => 'No such user found!!!'],404);
        }
     }

  }
  
  public function Delete($id)
  {
    $userdel = User::find($id);
    if($userdel)
    {
      $userdel ->delete();
      return response()->json([
        'status' => 200,
        'message' => 'user deleted successfully'],200);
    }
    else
    {
        return response()->json([
            'status' => 404,
            'message' => 'No user!!'],404);
    }
  }
  public function Logout(Request $request) {
     Auth::logout();
     return response()->json([
        'status' => 200,
        'message' => 'user loggedout successfully'],200);
  }
}
