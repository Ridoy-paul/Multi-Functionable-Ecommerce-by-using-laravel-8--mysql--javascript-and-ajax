<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class PromotionBannerCon extends Controller
{
    // ads Banner index page
    public function index(){
        $banners = DB::table('promotion_banners')->get();
        return view('cms.adsBanner.all_banner', compact('banners'));
    }

    // Add Category Function
    public function Add_ads_banner(Request $request){
        $request->validate([
            'banner_title' => 'required|unique:promotion_banners',
            'image' => 'required',
            
        ]);


        $banner_image = $request->file('image');
        $name_gen = hexdec(uniqid()).".".$banner_image->getClientOriginalExtension();
        Image::make($banner_image)->resize(620, 277)->save('images/'.$name_gen);
        $last_img = 'images/'.$name_gen;


        $data = array();
        $data['banner_title'] = $request->banner_title;
        $data['serial_num'] = $request->serial_num;
        $data['image'] = $last_img;
        $data['created_at'] = Carbon::now();

        DB::table('promotion_banners')->insert($data);
        return Redirect()->back()->with('status', 'New Ads Banner Added Successfully');

    }


    // Edit Ads Banner Function
    public function EditAdsBanner($id){
        $banner = DB::table('promotion_banners')-> where('id', $id) ->first();
        return view('cms.adsBanner.edit_banner', compact('banner'));
    }

    // Update Ads Banner Function
    public function UpdateAdsBanner(Request $request, $id){

        $old_image = $request->old_image;
        $data = array();
        // $brand_image = $request->file('brand_image');
        $cat_image = $request->file('image');

        if($cat_image){
            
            $name_gen = hexdec(uniqid()).".".$cat_image->getClientOriginalExtension();
            Image::make($cat_image)->resize(620, 277)->save('images/'.$name_gen);
            $last_img = 'images/'.$name_gen;
            $data['image'] = $last_img;
            
            if($old_image){
                unlink($old_image);
            }
           
        }

        $data['banner_title'] = $request->banner_title;
        $data['serial_num'] = $request->serial_num;
        $data['updated_at'] = Carbon::now();
        DB::table('promotion_banners')-> where('id', $id) ->update($data);
        return Redirect() -> route('all_promotion_banner')->with('status', 'Ads Banner Update Successfully');
        
    }
}
