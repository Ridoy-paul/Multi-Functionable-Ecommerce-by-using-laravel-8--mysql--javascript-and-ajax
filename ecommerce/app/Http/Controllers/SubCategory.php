<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubCategory extends Controller
{
    // Sub Category index page
    public function index(){
        $categories = DB::table('categories')->orderBy('id', 'DESC')->get();

        $Sub_categories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.catID', 'categories.id')
            ->select('sub_categories.*', 'categories.name')
            ->latest()->get();

        return view('cms.subcat.all_sub_cat', compact('categories', 'Sub_categories'));
    }

    // Add Sub Category Function
    public function add_Sub_Category(Request $request){
        $request->validate([
            'catID' => 'required',
            'sub_cat_name' => 'required',
            'url' => 'required',
            
        ]);

        $data = array();
        $data['catID'] = $request->catID;
        $data['sub_cat_name'] = $request->sub_cat_name;
        $data['url'] = $request->url;
        $data['active'] = 1;
        $data['created_at'] = Carbon::now();

        DB::table('sub_categories')->insert($data);
        return Redirect()->back()->with('status', 'Sub-Category Added Successfully');

    }

    // Deactive Sub Category Function
    public function DeactiveSubCategory($id){

        $data = array();
        $data['active'] = 0;
        $data['updated_at'] = date("Y-m-d");
        DB::table('sub_categories')-> where('id', $id) ->update($data);

        return redirect()->back()->with('status', 'Sub-Category Deactive Successfully');

    }

    // Active Sub Category Function
    public function ActiveSubCategory($id){

        $data = array();
        $data['active'] = 1;
        $data['updated_at'] = date("Y-m-d");
        DB::table('sub_categories')-> where('id', $id) ->update($data);

        return redirect()->back()->with('status', 'Sub-Category Active Successfully');

    }

    // Edit Sub Category Function
    public function EditSubCategory($id){
        $categories = DB::table('categories')->orderBy('id', 'DESC')->get();

        $Subcategory = DB::table('sub_categories')-> where('id', $id) ->first();
        return view('cms.subcat.edit_sub_cat', compact('categories', 'Subcategory'));
    }

    // Update Sub Category Function
    public function UpdateSubCategory(Request $request, $id){

        
        $request->validate([
            'catID' => 'required',
            'sub_cat_name' => 'required',
            'url' => 'required',
            
        ]);

        $data = array();
        $data['catID'] = $request->catID;
        $data['sub_cat_name'] = $request->sub_cat_name;
        $data['url'] = $request->url;
        $data['updated_at'] = Carbon::now();

        DB::table('sub_categories')-> where('id', $id) ->update($data);
        return Redirect() -> route('all_sub_cat')->with('status', 'Sub Category Update Successfully');
        
    }
}
