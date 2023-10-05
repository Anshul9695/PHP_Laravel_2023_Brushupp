<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class SizeController extends Controller
{
    public function SizeIndex()
    {
        return view('Admin.Product_Attr.add_size');
    }
    public function sizeAdd(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'sku' => 'required',
            'size' => 'required'

        ]);
        if ($validate->fails()) {
           return response()->json(['status'=>400,'message'=>$validate->getMessageBag()]);
        }else{
            $size=new Size();
            $size->sku=$request->sku;
            $size->size=$request->size;
            $size->save();
            return response()->json(['status'=>200,'message'=>'size Added successfully']);
        }
    }
    public function sizeList(){
        return view('Admin.Product_Attr.sizeList');
    }
    public function sizeListData(){

    }
}
