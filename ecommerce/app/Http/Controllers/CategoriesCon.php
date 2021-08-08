<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;



class CategoriesCon extends Controller
{
    // Category index page
    public function index(){
        $categories = DB::table('categories')->orderBy('id', 'DESC')->get();
        return view('cms.categories.all_category', compact('categories'));
    }

    // Add Category Function
    public function addCategory(Request $request){
        $request->validate([
            'name' => 'required|unique:categories',
            'url' => 'required|unique:categories',
            'image' => 'required',
            'serial_number' => 'unique:categories',

            
        ]);


        $cat_image = $request->file('image');

        $name_gen = hexdec(uniqid()).".".$cat_image->getClientOriginalExtension();
        Image::make($cat_image)->resize(39, 39)->save('images/'.$name_gen);
        $last_img = 'images/'.$name_gen;


        $data = array();
        $data['name'] = $request->name;
        $data['url'] = $request->url;
        $data['serial_number'] = $request->serial_number;
        $data['image'] = $last_img;
        $data['active'] = 1;
        $data['created_at'] = date("Y-m-d");

        DB::table('categories')->insert($data);

        
        return Redirect()->back()->with('status', 'Category Added Successfully');

    }

    // Deactive Category Function
    public function deactiveCategory($id){

        $data = array();
        $data['active'] = 0;
        $data['updated_at'] = date("Y-m-d");
        DB::table('categories')-> where('id', $id) ->update($data);

        return redirect()->back()->with('status', 'Category Deactive Successfully');

    }

    // Active Category Function
    public function ActiveCategory($id){

        $data = array();
        $data['active'] = 1;
        $data['updated_at'] = date("Y-m-d");
        DB::table('categories')-> where('id', $id) ->update($data);

        return redirect()->back()->with('status', 'Category Active Successfully');

    }

    // Edit Category Function
    public function EditCategory($id){
        $category = DB::table('categories')-> where('id', $id) ->first();
        return view('cms.categories.edit_category', compact('category'));
    }

    // Update Category Function
    public function UpdateCategory(Request $request, $id){

        $old_image = $request->old_image;

        // $brand_image = $request->file('brand_image');
        $cat_image = $request->file('image');

        if($cat_image){
            
            $name_gen = hexdec(uniqid()).".".$cat_image->getClientOriginalExtension();
            Image::make($cat_image)->resize(39, 39)->save('images/'.$name_gen);
            $last_img = 'images/'.$name_gen;
            
            
            if($old_image){
                unlink($old_image);
            }
            $data = array();
            $data['name'] = $request->name;
            $data['serial_number'] = $request->serial_number;
            $data['image'] = $last_img;
            $data['updated_at'] = Carbon::now();

            DB::table('categories')-> where('id', $id) ->update($data);
            return Redirect() -> route('all_cat')->with('status', 'Category Update Successfully');
        }
        else {
            $data = array();
            $data['name'] = $request->name;
            $data['url'] = $request->url;
            $data['serial_number'] = $request->serial_number;
            $data['updated_at'] = Carbon::now();
            DB::table('categories')-> where('id', $id) ->update($data);
            return Redirect() -> route('all_cat')->with('status', 'Category Update Successfully');
        }
    }

    
}
