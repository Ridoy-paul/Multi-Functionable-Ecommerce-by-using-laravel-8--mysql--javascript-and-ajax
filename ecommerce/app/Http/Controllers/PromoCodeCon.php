<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PromoCodeCon extends Controller
{
    // Category index page
    public function index(){
        $promoCodes = DB::table('promo_codes')->orderBy('id', 'DESC')->get();
        return view('cms.promo.all_promo_code', compact('promoCodes'));
    }

    // Add Category Function
    public function AddPromoCode(Request $request){
        $request->validate([
            'code' => 'required|unique:promo_codes',
            'discount_type' => 'required',
        ]);


        $data = array();
        $data['code'] = $request->code;
        $data['discount_type'] = $request->discount_type;
        $data['d_amount'] = $request->d_amount;
        $data['max_d_amount'] = $request->max_d_amount;
        $data['m_buy_amount'] = $request->m_buy_amount;
        $data['expire_date'] = $request->expire_date;
        $data['active'] = $request->active;
        $data['created_at'] = date("Y-m-d");

        DB::table('promo_codes')->insert($data);
        return Redirect()->back()->with('status', 'Promo Code Added Successfully');

    }

    // Edit Promo Function
    public function EditPromo($id){
        $promo = DB::table('promo_codes')->where('id', $id) ->first();
        return view('cms.promo.edit_promo', compact('promo'));
    }

    // Update Promo Function
    public function UpdatePromo(Request $request, $id){

        $data = array();
        $data['code'] = $request->code;
        $data['discount_type'] = $request->discount_type;
        $data['d_amount'] = $request->d_amount;
        $data['max_d_amount'] = $request->max_d_amount;
        $data['m_buy_amount'] = $request->m_buy_amount;
        $data['expire_date'] = $request->expire_date;
        $data['active'] = $request->active;
        $data['updated_at'] = date("Y-m-d");

        DB::table('promo_codes')-> where('id', $id) ->update($data);
        return Redirect() -> route('all_promo_code')->with('status', 'Promo Code Update Successfully');
    }

}
