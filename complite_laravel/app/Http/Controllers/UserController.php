<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if(session()->has('LoggedInUser')){
            return redirect('/profile');
        }else{
            return view('auth.register');
        }
  
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
        } else {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'User Registerd successfully'
            ]);
        }
    }
    public function loginPost(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => 'required|min:6'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validation->getMessageBag()
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('LoggedInUser', $user->id);
                    return response()->json([
                        'status' => 200,
                        'message' => 'success'
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'message' => 'Email Or Password is InCorrect'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'User Not Found'
                ]);
            }
        }
    }

    public function profile(){
        $data=['userInfo'=>DB::table('users')->where('id',session('LoggedInUser'))->first()];

        return view('auth.profile',$data);
    }
    public function logout(){
        if(session()->has('LoggedInUser')){
            session()->pull('LoggedInUser');
            return redirect('/');
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
