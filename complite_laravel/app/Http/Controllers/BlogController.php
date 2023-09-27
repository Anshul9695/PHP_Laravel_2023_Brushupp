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
    public function postListByUser(){
        return view('blogs.list_blog');
    }
    public function get_post_list(Request $request){
        $data = DB::table('users')->where('id', session('LoggedInUser'))->first(); //get logged in user id
        $user_id=$data->id;
       //$blog_list=Blog::find($user_id);
       $list=DB::table('blogs')
       ->leftJoin('users','users.id','blogs.user_id')
       ->whereUserId($user_id)
       ->get();
    
       //list of blog
      // $blog_list = Blog::whereUserId($user_id)->get();
      return response()->json([
        'status'=>200,
        'blog_list'=>$list,
        'message'=>'data getting successfully'
      ]);
    }
    public function get_all_post_front(Request $request){
        $list=DB::table('blogs')
        ->select(
            'blogs.id',
            'blogs.blog_name',
            'blogs.blog_title',
            'blogs.discription',
            'blogs.blog_image',
            'users.name as author_name',
            'users.id as author_id',
            'blogs.status',
        )
        ->leftJoin('users','users.id','blogs.user_id')
        ->where('blogs.status','=',1)
        ->get();
       return view('blogs.display_all_front')->with('list',$list);
    }
    public function viewDetails($id){
        // echo $id;
        // die;
        // $blog_id=Blog::find($id);
        $data=DB::table('blogs')
        ->select(
            'blogs.id',
            'blogs.blog_name',
            'blogs.blog_title',
            'blogs.discription',
            'blogs.blog_image',
            'blogs.created_at',
           'users.name as author_name',
           'users.id as author_id',
            'blogs.status',

            'comments.comment_id',
            'comments.c_name',
            'comments.c_email',
            'comments.comment',
           
        )
        ->leftJoin('users','users.id','blogs.user_id')
        ->leftJoin('comments','comments.blog_id','blogs.id')
        ->where('blogs.id','=',$id)
        ->get();
        // echo "<pre>";
        // print_r($data);
    return view('blogs.detailsView')->with('data',$data);
    //    return response()->json(['status'=>200,'message'=>'getting data successfully','data'=>$blog_id]);
    }
  
}
