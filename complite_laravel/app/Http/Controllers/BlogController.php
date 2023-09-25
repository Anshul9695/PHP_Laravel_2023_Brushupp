<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class BlogController extends Controller
{
    public function create_blog()
    {
        return view('blogs.create_blog');
    }
    public function savePost(Request $request)
    {
        $validate = FacadesValidator::make($request->all(), [
            'blog_name' => 'required',
            'blog_title' => 'required',
            'discription' => 'required',
            'blog_image' => 'required',

        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                 'message' => $validate->getMessageBag()
        ]);
        } else {
            $data = DB::table('users')->where('id', session('LoggedInUser'))->first(); //get logged in user id
            // print_r($data->id);
            $user_id = $data->id;
            $blog_model = new Blog();
            $blog_model->blog_name = $request->blog_name;
            $blog_model->blog_title = $request->blog_title;
            $blog_model->discription = $request->discription;
            $blog_model->status = $request->status;
            $blog_model->user_id = $user_id;
            if ($request->hasFile('blog_image')) {
                $file = $request->file('blog_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->storeAs('public/uploads/blogs/', $filename);
            }
            $blog_model->blog_image = $filename;
            $blog_model->save();

            return response()->json(['status' => 200, 'message' => 'blog saved successfully']);
        }
    }
}
