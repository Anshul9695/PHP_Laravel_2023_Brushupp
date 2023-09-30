<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function add_category()
    {
        return view('Admin.category.add_category');
    }
    public function categoryPost(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'cat_name' => 'required',
            'cat_image' => 'required',
            'cat_discription' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'message' => $validate->getMessageBag()]);
        } else {
            $category = new Category();
            $category->cat_name = $request->cat_name;
            $category->cat_discription = $request->cat_discription;
            if ($request->hasFile('cat_image')) {
                $file = $request->file('cat_image');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->storeAs('public/uploads/catImage/', $filename);
                $category->cat_image = $filename;
            }
            $category->save();
            return response()->json(['status' => 200, 'message' => 'category created successfully']);
        }
    }
    public function categoryList()
    {
        return view('Admin.category.category_list');
    }
    public function CateList(Request $request)
    {
        $category_list = new Category();
        $data = $category_list->all();
        // echo "<pre>";
        // print_r($data);
        // di
        return response()->json(['status' => 200, 'data' => $data, 'message' => 'getting list of category']);
    }
    public function deleteData($id)
    {
        $category = Category::where('id', $id);
        $category->delete($id);
        return response()->json(['status' => 200, 'message' => 'data deletade successfully']);
    }
    public function editCat($id)
    {
        $cat = DB::table('categories')->where('id', $id)->first();
        return view('Admin.category.edit_category')->with('cat', $cat);
    }
    public function updateCat(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'cat_name' => 'required',
            'cat_discription' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'message' => $validate->getMessageBag()]);
        } else {
            $id= $data['id']=$request->id;
            $category = Category::find($id);
            $data['cat_name'] = $request->cat_name;
            $data['cat_discription'] = $request->cat_discription;
            
           if($request->hasFile('cat_image')){
            $destinatin='public/uploads/catImage/'.$category->image;
            if($category->file!='' && $category->file !=null){
             $file_old=$destinatin.$category->file;
             unlink(($file_old));
            }
            $file = $request->file('cat_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->storeAs('public/uploads/catImage/', $filename);
            $category->cat_image = $filename;

           }
            $category->update($data);
            return response()->json(['status' => 200, 'message' => 'Recard update successfully']);
        }
    }
}
