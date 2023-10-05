<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function add_brand_form()
    {
        return view('Admin.Brands.add_brand');
    }
    public function AddBrand(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'brand_name'=>'required',
            'brand_description'=>'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'message' => $validate->getMessageBag()]);
        } else {
            $brand_model = new Brand();
            $brand_model['brand_name'] = $request->brand_name;
            $brand_model['brand_description'] = $request->brand_description;
            $brand_model['display_status'] = $request->display_status;
            if($request->hasFile('brand_image')){
                $file=$request->file('brand_image');
                $extention=$file->getClientOriginalExtension();
                $filename=time().'.'.$extention;
                $file->storeAs('public/uploads/brandImage',$filename);
                $brand_model['brand_image']=$filename;
            }
            $brand_model->save();
            return response()->json(['status'=>200,'message'=>'brand Added successfully']);
        }
    }
    public function getBrand(){
        return view('Admin.Brands.brand_list');
    }
    public function getBrandData(){      
        $brand=new Brand();
        $data=$brand->all();
        return response()->json(['status'=>200,'data'=>$data,'message'=>'getting all data']);
    }
    public function deleteDatabrand($brand_id)
    {
        $category = Brand::where('brand_id', $brand_id);
        $category->delete($brand_id);
        return response()->json(['status' => 200, 'message' => 'brand deletade successfully']);
    }
    public function editBrand($brand_id){
        $brand=DB::table('brands')->where('brand_id',$brand_id)->first();
        // p($brand);
        
        return view('Admin.Brands.edit_brand')->with('brand',$brand);
    }
    public function updateBrand(Request $request){
        $validate = Validator::make($request->all(), [
            'brand_name' => 'required',
            'brand_description' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'message' => $validate->getMessageBag()]);
        } else {
           
            $brand_id= $data['brand_id']=$request->brand_id;
            $category =Brand::find($brand_id);
            $data['brand_name'] = $request->brand_name;
            $data['brand_description'] = $request->brand_description;
            $data['display_status'] = $request->display_status;
           if($request->hasFile('brand_image')){
            $destinatin='public/uploads/brandImage/'.$category->image;
            if($category->file!='' && $category->file !=null){
             $file_old=$destinatin.$category->file;
             unlink(($file_old));
            }
            $file = $request->file('cat_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->storeAs('public/uploads/brandImage/', $filename);
            $category->cat_image = $filename;
           }
            $category->update($data);
            return response()->json(['status' => 200, 'message' => 'Recard update successfully']);
        }
    }
}
