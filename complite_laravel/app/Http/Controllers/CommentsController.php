<?php

namespace App\Http\Controllers;

use App\Models\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
   public function addComment(Request $request){
    // print_r($_POST);
    // die;
    $validate=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email|max:50',
        'comment'=>'required'
    ]);
    if($validate->fails()){
return response()->json([
    'status'=>400,
    'message'=>$validate->getMessageBag(),
]);
    }else{
        $blog_model=new comments();
        $blog_model->c_name=$request->name;
        $blog_model->c_email=$request->email;
        $blog_model->comment=$request->comment;
        $blog_model->blog_id=$request->blog_id;
        $blog_model->save();
       
return response()->json(['status'=>200,'message'=>'comment added successfully']);
    }
   }
}
