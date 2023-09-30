<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $admin_data=DB::table('admins')->where('id',session('loggedinUser'))->first();
        $user_name=$admin_data->name;
        $user_profile=$admin_data->profile;
        session(['user_name'=>$user_name]);  
        session(['user_profile'=>$user_profile]);  
        return view('Admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function RegisterAdmin()
    {
        return view('Admin.admin_register');
    }
    public function registerpost(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:6|max:50',
                'cnf_password' => 'required|min:6|same:password',
            ],
            [
                'cnf_password.same' => 'password did not mached',
                'cnf_password.required' => 'confirm password is required'
            ]
        );
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'message' => $validate->getMessageBag()]);
        } else {
            $admin = new Admins();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $extention = $file->getClientOriginalExtension();
                $file_name = time() . '.' . $extention;
                $file->storeAs('public/uploads/images/', $file_name);
                $admin->profile = $file_name;
            }
            $admin->save();
            return response()->json(['status' => 200, 'message' => 'Admin Register successfully']);
        }
    }
    public function admin_login()
    {
        return view('Admin.admin_login');
    }
    public function login_post(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'message' => $validate->getMessageBag()]);
        } else {
            $admin = Admins::where('email', $request->email)->first();
            if ($admin) {
                if (Hash::check($request->password, $admin->password)) {
                    $request->session()->put('loggedinUser', $admin->id);
                    return redirect('dashboard');
                } else {
                    return response()->json(['status' => 401, 'message' => 'Email or password is inCorrect']);
                }
            } else {
                return response()->json(['status' => 400, 'message' => 'NO User Found']);
            }
        }
    }
    public function logout()
    {
        if (session()->has('loggedinUser')) {
            session()->pull('loggedinUser');
            return redirect('admin_login');
        }
    }

}
