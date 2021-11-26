<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        return view ('test');
    }

    public function get(){
        $data= Test::orderBy('id','DESC')->get();
       // return view('test',compact('data'));
        return response()->json($data);
    }

    public function add(Request $request){
        $this->validate($request,[
            'name'=>'required|max:20',
            'address'=>'required|max:30'
        ]);
        $data = new Test();
        $data->name = $request->name;
        $data->address = $request->address;
        $data->save();
        return response()->json($data);
    }
    public function edit($id){
        $data=Test::findOrFail($id);
        return response()->json($data);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required|max:20',
            'address'=>'required|max:30'
        ]);
        $data = Test::findOrFail($id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->update();
        return response()->json($data);
    }
    //public function del($id){
      //  $data = Test::findOrFail($id);
       // $data->delete();
       // return response()->json($data);
    //}
    public function del($id){
        $data=Test::findOrFail($id);
        $data->delete();
        return response()->json($data);
    }
}
