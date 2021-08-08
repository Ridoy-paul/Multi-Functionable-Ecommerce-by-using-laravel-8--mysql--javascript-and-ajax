<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Sub_Shipping_AreaCon extends Controller
{
    // shipping Sub Area index page
    public function index(){
        $shippingCharges = DB::table('shipping_charges')->orderBy('name', 'asc')->get();
        $thanas = DB::table('shipping_sub_areas')
        ->join('shipping_charges', 'shipping_sub_areas.ship_id', 'shipping_charges.id')
        ->select('shipping_sub_areas.*', 'shipping_charges.name')
        ->orderBy('shipping_charges.name', 'asc')
        ->get();
        // ->orderBy('id', 'DESC')->
        return view('cms.shipping.shipping_sub.all_sub_area', compact('thanas', 'shippingCharges'));
    }

    // Add Shipping Sub Area Address Function
    public function AddNewThana(Request $request){
        $request->validate([
            'shipping_sub_name' => 'required|unique:shipping_sub_areas',
            'District_name' => 'required',
        ]);

        $data = array();
        $data['ship_id'] = $request->District_name;
        $data['shipping_sub_name'] = $request->shipping_sub_name;
        $data['created_at'] = date("Y-m-d");

        DB::table('shipping_sub_areas')->insert($data);
        return Redirect()->back()->with('status', 'New Thana Address Added Successfully');

    }

    // Edit Shipping Sub Area Function
    public function EditThana($id){
        $shippingCharges = DB::table('shipping_charges')->orderBy('name', 'asc')->get();
        $thana = DB::table('shipping_sub_areas')
        ->where('id', $id)
        ->first();
        return view('cms.shipping.shipping_sub.edit_sub_area', compact('shippingCharges', 'thana'));
    }

    // Update Shipping Sub Area Function
    public function UpdateThana(Request $request, $id){

        $data = array();
        $data['ship_id'] = $request->District_name;
        $data['shipping_sub_name'] = $request->shipping_sub_name;
        $data['updated_at'] = Carbon::now();
        DB::table('shipping_sub_areas')-> where('id', $id) ->update($data);
        return Redirect()->route('shipping_sub_area')->with('status', 'Shipping Info Update Successfully');
    }
}
