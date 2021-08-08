<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Image;

use Illuminate\Http\Request;

class PopupModalCon extends Controller
{
    // Category index page
    public function index(){
        $popupModals = DB::table('shop_settings')->first();
        return view('cms.pages.popup_modal', compact('popupModals'));
    }

    // Add popup
    public function updatePopup(Request $request, $id){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:500',
        ]);

        
        $old_image = $request->old_image;
        $modal_image = $request->file('popup_modal_image');
        if($modal_image){
            
            $name_gen = hexdec(uniqid()).".".$modal_image->getClientOriginalExtension();
            Image::make($modal_image)->resize(400, 400)->save('images/'.$name_gen);
            $last_img = 'images/'.$name_gen;
            
            
            if($old_image){
                unlink($old_image);
            }
            $data = array();
            $data['popup_modal_title'] = $request->title;
            $data['popup_modal_description'] = $request->description;
            $data['popup_modal_image'] = $last_img;
            $data['updated_at'] = Carbon::now();

            DB::table('shop_settings')-> where('id', $id) ->update($data);
            return Redirect() ->route('popup_modal')->with('status', 'Popup Modal Update Successfully');
        }
        else {
            $data = array();
            $data['popup_modal_title'] = $request->title;
            $data['popup_modal_description'] = $request->description;
            $data['updated_at'] = Carbon::now();
            DB::table('shop_settings')-> where('id', $id) ->update($data);
            return Redirect() ->route('popup_modal')->with('status', 'Popup Modal Update Successfully');
        }
    }
}
