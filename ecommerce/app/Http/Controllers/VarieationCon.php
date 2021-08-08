<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Image;

class VarieationCon extends Controller
{
    // Varieation index page
    public function index(){
        $varieations = DB::table('varieations')->orderBy('id', 'DESC')->get();
        return view('cms.varieation.all_varieation', compact('varieations'));
    }

    // Add Varieation Function
    public function AddVarieation(Request $request){
        $request->validate([
            'vari_name' => 'required|unique:varieations',
            
        ]);

        $data = array();
        $data['vari_name'] = $request->vari_name;
        $data['active'] = 1;
        $data['created_at'] = date("Y-m-d");

        DB::table('varieations')->insert($data);
        return Redirect()->back()->with('status', 'New Varieation Added Successfully');

    }

    // Edit Varieation Function
    public function EditVarieation($id){
        $varieation = DB::table('varieations')-> where('id', $id) ->first();
        return view('cms.varieation.edit_varieation', compact('varieation'));
    }

    // Update Varieation Function
    public function UpdateVarieation(Request $request, $id){

        $request->validate([
            'vari_name' => 'required|unique:varieations',
            
        ]);

        $data = array();
        $data['vari_name'] = $request->vari_name;
        $data['updated_at'] = date("Y-m-d");

        DB::table('varieations')-> where('id', $id) ->update($data);
        return Redirect() -> route('all_varieation')->with('status', 'Varieation Update Successfully');
        
        
    }
}
