<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ShippingCrgCon extends Controller
{
    // shipping Crg index page
    public function index(){
        $shipping_crgs = DB::table('shipping_charges')->orderBy('id', 'DESC')->get();
        return view('cms.shipping.all_shipping_crg', compact('shipping_crgs'));
    }

    // Add Shipping Address Function
    public function AddShippingAddress(Request $request){
        $request->validate([
            'name' => 'required|unique:shipping_charges',
            'amount' => 'required',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['amount'] = $request->amount;
        $data['created_at'] = date("Y-m-d");

        DB::table('shipping_charges')->insert($data);
        return Redirect()->back()->with('status', 'New Shipping Address Added Successfully');

    }

    // Edit Shipping Function
    public function EditShipping($id){
        $shipping = DB::table('shipping_charges')-> where('id', $id) ->first();
        return view('cms.shipping.edit_shipping', compact('shipping'));
    }

    // Update Shipping Function
    public function UpdateShipping(Request $request, $id){

        $data = array();
        $data['name'] = $request->name;
        $data['amount'] = $request->amount;
        $data['updated_at'] = Carbon::now();
        DB::table('shipping_charges')-> where('id', $id) ->update($data);
        return Redirect()->route('all_shipping_crg')->with('status', 'Shipping Info Update Successfully');
    }
}
