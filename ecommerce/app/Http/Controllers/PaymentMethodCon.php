<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class PaymentMethodCon extends Controller
{
    // Category index page
    public function index(){
        $payment_methods = DB::table('payment_methods')->orderBy('id', 'DESC')->get();
        return view('cms.payment_method.all_payment_method', compact('payment_methods'));
    }

    // Add Category Function
    public function AddPayment_method(Request $request){
        $request->validate([
            'method_name' => 'required|unique:payment_methods',
        ]);

        $data = array();
        $data['method_name'] = $request->method_name;
        $data['number'] = $request->number;
        $data['created_at'] = Carbon::now();

        DB::table('payment_methods')->insert($data);
        return Redirect()->back()->with('status', 'New Payment Method Added Successfully');

    }

    // Edit payment Method Function
    public function EditPMethod($id){
        $pmethod = DB::table('payment_methods')-> where('id', $id) ->first();
        return view('cms.payment_method.edit', compact('pmethod'));
    }

    // Update payment Method Function
    public function UpdatePMethod(Request $request, $id){

        $data = array();
        $data['method_name'] = $request->method_name;
        $data['number'] = $request->number;
        $data['updated_at'] = Carbon::now();

        DB::table('payment_methods')-> where('id', $id) ->update($data);
        return Redirect() -> route('all_payment_method')->with('status', 'Payment Method Update Successfully');
    }

}
