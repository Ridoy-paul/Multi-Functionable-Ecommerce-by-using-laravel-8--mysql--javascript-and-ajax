<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Image;

use Illuminate\Http\Request;

class ShopSettingCon extends Controller
{
    // Shop Setting Added
    public function addSetting(Request $request){
        $request->validate([
            'shop_name' => 'required',
            'logo' => 'required',
            'address' => 'required',
            'phone_1' => 'required',
            'email' => 'required',
            
        ]);

        $logo = $request->file('logo');
        $name_gen = hexdec(uniqid()).".".$logo->getClientOriginalExtension();
        Image::make($logo)->resize(205, 65)->save('images/'.$name_gen);
        $last_img = 'images/'.$name_gen;

        $data = array();
        $data['shop_name'] = $request->shop_name;
        $data['logo'] = $last_img;
        $data['address'] = $request->address;
        $data['phone_1'] = $request->phone_1;
        $data['phone_2'] = $request->phone_2;
        $data['email'] = $request->email;
        $data['facebook'] = $request->facebook;
        $data['youtube'] = $request->youtube;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;
        $data['linkden'] = 'null';
        $data['privacy_policy'] = $request->editor1;
        $data['mission_and_vission'] = $request->editor2;
        $data['Terms_and_conditions'] = $request->editor3;
        $data['created_at'] = Carbon::now();

        DB::table('shop_settings')->insert($data);
        return Redirect()->back()->with('status', 'Setting Added Successfully');

    }

    // Shop Setting Edit
    public function EditShopSetting($id){
        $shop_setting = DB::table('shop_settings')-> where('id', $id) ->first();
        return view('cms.setting.edit_shop_setting', compact('shop_setting'));
    }

    // Update Shop Settings
    public function UpdateShopSetting(Request $request, $id){

        $old_image = $request->old_image;
        $logo = $request->file('logo');

        if($logo){
            
            $name_gen = hexdec(uniqid()).".".$logo->getClientOriginalExtension();
            Image::make($logo)->resize(205, 65)->save('images/'.$name_gen);
            $last_img = 'images/'.$name_gen;
            
            if($old_image){
                unlink($old_image);
            }
            $data = array();
            $data['shop_name'] = $request->shop_name;
            $data['logo'] = $last_img;
            $data['address'] = $request->address;
            $data['phone_1'] = $request->phone_1;
            $data['phone_2'] = $request->phone_2;
            $data['email'] = $request->email;
            $data['facebook'] = $request->facebook;
            $data['youtube'] = $request->youtube;
            $data['instagram'] = $request->instagram;
            $data['twitter'] = $request->twitter;
            $data['linkden'] = 'null';
            $data['privacy_policy'] = $request->editor1;
            $data['mission_and_vission'] = $request->editor2;
            $data['Terms_and_conditions'] = $request->editor3;
            $data['updated_at'] = Carbon::now();

            DB::table('shop_settings')-> where('id', $id) ->update($data);
            return Redirect() -> route('admin_setting')->with('status', 'Company Setting Update Successfully');
        }
        else {
            $data = array();
            $data['shop_name'] = $request->shop_name;
            $data['address'] = $request->address;
            $data['phone_1'] = $request->phone_1;
            $data['phone_2'] = $request->phone_2;
            $data['email'] = $request->email;
            $data['facebook'] = $request->facebook;
            $data['youtube'] = $request->youtube;
            $data['instagram'] = $request->instagram;
            $data['twitter'] = $request->twitter;
            $data['linkden'] = 'null';
            $data['privacy_policy'] = $request->editor1;
            $data['mission_and_vission'] = $request->editor2;
            $data['Terms_and_conditions'] = $request->editor3;
            $data['updated_at'] = Carbon::now();

            DB::table('shop_settings')-> where('id', $id) ->update($data);
            return Redirect()-> route('admin_setting')->with('status', 'Company Setting Update Successfully');
        }
    }
}
