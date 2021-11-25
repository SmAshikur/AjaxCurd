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
}
