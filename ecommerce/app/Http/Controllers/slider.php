<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Image;

class slider extends Controller
{
    // Slider index page
    public function index(){
        $sliders = DB::table('sliders')->get();
        return view('cms.slider.all_slider', compact('sliders'));
    }

    // Add Slider Function
    public function AddSlider(Request $request){
        $request->validate([
            'slider_title' => 'required|unique:sliders',
            'image' => 'required',
            
        ]);


        $slider_image = $request->file('image');
        $name_gen = hexdec(uniqid()).".".$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1050, 355)->save('images/'.$name_gen);
        $last_img = 'images/'.$name_gen;

        $data = array();
        $data['slider_title'] = $request->slider_title;
        $data['meta_title'] = $request->meta_title;
        $data['image'] = $last_img;
        $data['created_at'] = Carbon::now();

        DB::table('sliders')->insert($data);
        return Redirect()->back()->with('status', 'New Slider Added Successfully');

    }

    
    // Edit Slider Function
    public function EditSlider($id){
        $slider = DB::table('sliders')-> where('id', $id) ->first();
        return view('cms.slider.edit_slider', compact('slider'));
    }

    // Update Slider Function
    public function UpdateSlider(Request $request, $id){

        $old_image = $request->old_image;
        $cat_image = $request->file('image');
        $data = array();

        if($cat_image){
            $name_gen = hexdec(uniqid()).".".$cat_image->getClientOriginalExtension();
            Image::make($cat_image)->resize(1050, 355)->save('images/'.$name_gen);
            $last_img = 'images/'.$name_gen;
            if($old_image){
                unlink($old_image);
            }
            $data['image'] = $last_img;
        }

        $data['slider_title'] = $request->slider_title;
        $data['meta_title'] = $request->meta_title;
        $data['updated_at'] = Carbon::now();

        DB::table('sliders')-> where('id', $id) ->update($data);
        return Redirect() -> route('all_slider')->with('status', 'Slider Update Successfully');

    }
}
