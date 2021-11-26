<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function image(){
        return view('image');
    }
    public function get(){
        $data= Image::orderBy('id','DESC')->get();
       // return view('test',compact('data'));
        return response()->json($data);
    }
    public function add(Request $request){
        $this->validate($request,[

            'image'=>'required'
        ]);

         $data=new Image();
         $data->name=$request->name;
         $data->name=$request->name;
         if($request->hasFile('image')){
            $file=$request->file('image');
            $extention= $file->getClientOriginalExtension();
            $fileName=time().'.'.$extention;
            $file->move('images/',$fileName);
            $data->image=$fileName;
        }
         $data->save();
         return response()->json($data);

    }
}
