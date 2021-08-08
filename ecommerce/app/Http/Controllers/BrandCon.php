<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Carbon;

class BrandCon extends Controller
{
    // Brand index page
    public function index(){
        $brands = DB::table('brands')->orderBy('id', 'DESC')->get();
        return view('cms.brand.all_brand', compact('brands'));
    }

    // Add Brand Function
    public function addBrand(Request $request){
        $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'url' => 'required|unique:brands|max:255',
            'image' => 'required',
        ]);


        $brand_image = $request->file('image');

        $name_gen = hexdec(uniqid()).".".$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(108, 108)->save('images/'.$name_gen);
        $last_img = 'images/'.$name_gen;


        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['url'] = $request->url;
        $data['image'] = $last_img;
        $data['created_at'] = Carbon::now();

        DB::table('brands')->insert($data);
        return Redirect()->back()->with('status', 'New Brand Added Successfully');

    }

    // Deactive Brand Function
    public function deactiveBrand($id){

        $data = array();
        $data['active'] = 0;
        $data['updated_at'] = date("Y-m-d");
        DB::table('brands')-> where('id', $id) ->update($data);
        return redirect()->back()->with('status', 'Brand Deactive Successfully');

    }

    // Active Brand Function
    public function ActiveBrand($id){

        $data = array();
        $data['active'] = 1;
        $data['updated_at'] = date("Y-m-d");
        DB::table('brands')-> where('id', $id) ->update($data);
        return redirect()->back()->with('status', 'Brand Active Successfully');

    }

    // Edit Brand Function
    public function EditBrand($id){
        $brand = DB::table('brands')-> where('id', $id) ->first();
        return view('cms.brand.edit_brand', compact('brand'));
    }

    // Update Brand Function
    public function UpdateBrand(Request $request, $id){

        
        $request->validate([
            'brand_name' => 'required|max:255',
            'url' => 'required|max:255',
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('image');

        if($brand_image){
            
            $name_gen = hexdec(uniqid()).".".$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(108, 108)->save('images/'.$name_gen);
            $last_img = 'images/'.$name_gen;
            
            if($old_image){
                unlink($old_image);
            }
            $data = array();
            $data['brand_name'] = $request->brand_name;
            $data['url'] = $request->url;
            $data['image'] = $last_img;
            $data['updated_at'] = Carbon::now();

            DB::table('brands')-> where('id', $id) ->update($data);
            return Redirect() -> route('all_brand')->with('status', 'Brand Update Successfully');
        }
        else {
            $data = array();
            $data['brand_name'] = $request->brand_name;
            $data['url'] = $request->url;
            $data['updated_at'] = Carbon::now();

            DB::table('brands')-> where('id', $id) ->update($data);
            return Redirect() -> route('all_brand')->with('status', 'Brand Update Successfully');
        }
    }
}
