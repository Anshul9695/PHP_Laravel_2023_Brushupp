<?php

namespace App\Http\Controllers;

use App\Mail\forgetPassword;
use App\Models\User;
// use Carbon\Carbon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {

        return view('auth.login');
    }
    public function create()
    {
        if (session()->has('LoggedInUser')) {
            return redirect('/profile');
        } else {
            return view('auth.register');
        }
    }

    public function forget()
    {
        return view('auth.forget');
    }
    public function reset_password(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        return view('auth.reset_password', ['email' => $email, 'token' => $token]);
    }
    public function resetPassword(Request $request)
    {
        $validater = Validator::make(
            $request->all(),
            [
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
            $user = DB::table('users')
            ->where('email', $request->email)
            ->whereNotNull('token')
            ->where('token', $request->token)->where('token_expire','>',Carbon::now())->exists();
            if ($user) {
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->password),
                    'token' => null,
                    'token_expire' => null
                ]);
                return response()->json(['status'=>200,'message'=>'New Password Updated  <a href="/">Login</a>']);
            }else{
                return response()->json(['status'=>401,'message'=>'Reset link Expired plase try Again']);
            }
        }
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

    public function profile()
    {
        $data = ['userInfo' => DB::table('users')->where('id', session('LoggedInUser'))->first()];

        return view('auth.profile', $data);
    }
    public function logout()
    {
        if (session()->has('LoggedInUser')) {
            session()->pull('LoggedInUser');
            return redirect('/');
        }
    }

    public function update_profile(Request $request)
    {
        $id = $request->id;
        $user_id = User::find($id);
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $extenstion = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extenstion;
            $file->storeAs('public/uploads/images/', $file_name);
            if ($user_id->picture) {
                Storage::delete('public/uploads/images/', $user_id->picture);
            }
        }
        User::where('id', $id)->update(['picture' => $file_name]);
        return response()->json(['status' => 200, 'message' => 'Profile Image Update Successfully..']);
    }
    public function update_profile_data(Request $request)
    {

        User::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'phone' => $request->phone,
        ]);
        return response()->json(['status' => 200, 'message' => 'User Profile Details Updated successfully']);
    }
    public function forget_password(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|max:50'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'message' => 'Email Not Found']);
        } else {
            $token = Str::uuid();
            $user = DB::table('users')->where('email', $request->email)->first();
            $details = [
                'body' => route('reset', ['email' => $request->email, 'token' => $token])
            ];
            if ($user) {
                User::where('email', $request->email)->update([
                    'token' => $token,
                    'token_expire' => Carbon::now()->addMinutes(10)->toDateTimeString()
                ]);
                Mail::to($request->email)->send(new forgetPassword($details));
                return response()->json(['status' => 200, 'message' => 'Reset password link has been send to your Email']);
            } else {
                return response()->json(['status' => 401, 'message' => 'Email is not Registerd with us']);
            }
        }
    }
}
