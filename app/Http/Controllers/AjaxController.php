<?php

namespace App\Http\Controllers;

use App\Models\Ajax;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajax(){
        return view('ajax');
    }
    public function get(){
        $data= Ajax::orderBy('id','DESC')->get();
        return response()->json($data);
    }
    public function add(Request $request){
        $request->validate([
            'name'=>'required|max:10',
            'address'=>'required|max:10',
        ]);
        $data = Ajax::insert([
            'name'=>$request->name,
            'address'=>$request->address,
        ]);
        return response()->json($data);
    }
    public function edit($id){
        $data=Ajax::findOrFail($id);
        return response()->json($data);
    }
    public function del($id){
        $data=Ajax::findOrFail($id);
        $data->delete();
        return response()->json($data);
    }
    public function up(Request $request, $id){
        $request->validate([
            'name'=>'required|max:10',
            'address'=>'required|max:10',
        ]);
        $data = Ajax::findOrFail($id);
        $data->name =$request->name;
        $data->address=$request->address;
        $data->save();
        return response()->json($data);
    }
}
