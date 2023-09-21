<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        
        return view('auth.login');
    }
    public function create()
    {
        return view('auth.register');
    }

    public function forget()
    {
        return view('auth.forget');
    }
    public function reset_password()
    {
        return view('auth.reset_password');
    }

    public function registerUser(Request $request)
    {

        $validater = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users|max:50',
                'password' => 'required|min:6|max:50',
                'cnf_password' => 'required|min:6|same:password',
            ],
            [
                'cnf_password.same' => 'password did not mached',
                'cnf_password.required' => 'confirm password is required'
            ]
        );
        if ($validater->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validater->getMessageBag(),
            ]);
        }else{

            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();
            return response()->json([
                'status'=>200,
                'message'=>'User Registerd successfully'
            ]);

        }
    }

    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
