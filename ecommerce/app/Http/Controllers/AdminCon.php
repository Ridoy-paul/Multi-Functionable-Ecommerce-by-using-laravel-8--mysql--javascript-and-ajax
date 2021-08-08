<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Admin;
use Illuminate\Support\Facades\Redirect;

class AdminCon extends Controller {

    public function index(){
        $my = "paul";
        return view('cms.pages.dashboard', compact('my'));
    }

    //Begin::Cms profile
    public function CMSProfile(){

        $admin_id = session()->get('admin_id');
        $admin_info = DB::table('admins')->where(['id'=>$admin_id])->first();
        return view('cms.pages.profile', compact('admin_info'));
    }
    //End::Cms profile

    

    // Login
    public function login(Request $request){
        
        $email = $request->email;
        $password =   $request->password;
        $pin = $request->pin;

        $result = DB::table('admins')->where(['email'=>$email, 'pin'=>$pin])->first();

        if(!empty($result->email)){
            if(Hash::check($password, $result->password)) {
                if($result->active == 1){
                    $request ->session()->put('admin_id', $result->id);
                    return redirect('/cms')->with('status', 'Login Successfully');
                }
                else {
                    $request->session()->flash('error', 'User Is Deactive!!');
                    return Redirect()->back();
                }
            } else {
                $request->session()->flash('error', 'Invalid User Information! Please Try Again');
                return Redirect()->back();
            }
        }
        else {
            $request->session()->flash('error', 'Invalid User Information! Please Try Again');
            return Redirect()->back();
        }
        
        
    }

    public function adminRegister(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins|max:255',
            'password' => 'required|confirmed|min:3',
            'pin' => 'required',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['pin'] = $request->pin;
        $data['created_at'] = Carbon::now();
        
        DB::table('admins')->insert($data);
        return Redirect('/cms/login');

        
    }

    public function admin_logout(Request $request){
        $request->session()->flush();
        return redirect('/cms/login');
        
    }

    //Begin:: Admin All ordres
    public function AllOrders() {
        $orders = DB::table('orders')
                ->join('users', 'orders.userID', 'users.id')
                ->select('orders.*', 'users.name')
                ->latest()
                ->get();
        
        return view('cms.orders.all_order', compact('orders'));
    }
    //End:: Admin All ordres

    //Begin:: Admin Pending ordres
    public function PendingOrders() {
        $orders = DB::table('orders')
                ->join('users', 'orders.userID', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('orders.order_status', 'pending')
                ->latest()
                ->get();
        
        return view('cms.orders.pending_orders', compact('orders'));
    }
    //End:: Admin Pending ordres

    //Begin:: Admin processing ordres
    public function ProcessingOrders() {
        $orders = DB::table('orders')
                ->join('users', 'orders.userID', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('orders.order_status', 'processing')
                ->latest()
                ->get();
        
        return view('cms.orders.processing_orders', compact('orders'));
    }
    //End:: Admin processing ordres

    //Begin:: Admin dispatched ordres
    public function DispatchedOrders() {
        $orders = DB::table('orders')
                ->join('users', 'orders.userID', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('orders.order_status', 'dispatched')
                ->latest()
                ->get();
        
        return view('cms.orders.dispatched_orders', compact('orders'));
    }
    //End:: Admin dispatched ordres

    //Begin:: Admin delivered ordres
    public function DeliveredOrders() {
        $orders = DB::table('orders')
                ->join('users', 'orders.userID', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('orders.order_status', 'delivered')
                ->latest()
                ->get();
        
        return view('cms.orders.delivered_orders', compact('orders'));
    }
    //End:: Admin delivered ordres

    //Begin:: Admin canceled ordres
    public function CanceledOrderes() {
        $orders = DB::table('orders')
                ->join('users', 'orders.userID', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('orders.order_status', 'canceled')
                ->latest()
                ->get();
        
        return view('cms.orders.canceled_orders', compact('orders'));
    }
    //End:: Admin canceled ordres

    //Begin:: Admin ordre details
    public function OrderDetails($id) {
        $ordersQ = DB::table('orders')
                    ->join('shipping_charges', 'orders.shippingID', 'shipping_charges.id')
                    ->select('orders.*', 'shipping_charges.name')
                    ->where('orders.id', $id)
                    ->first();
        
        return view('cms.orders.orderDetails', compact('ordersQ'));
    }
    //End:: Admin ordres details

    //Begin:: Admin Order status change
    public function AdminOrderStatusChange(Request $request) {
        $data = array();
        $invID = $request->invID;
        $changeStatus = $request->order_status;
        if($changeStatus == ''){

        }
        if($changeStatus != ''){
            
           
            $data['order_status'] = $changeStatus;
            $data['updated_at'] = Carbon::now();
            DB::table('orders')-> where('id', $invID) ->update($data);
            return redirect()->back()->with('status', 'Order Status Changed Successfully.');
        }
        else {
            return redirect()->back()->with('notAllow', 'Please Select A Cancel Reason!');
        }
    }
    //End:: Admin Order status change

    //Begin:: Admin All Customers
    public function Admin_all_customers() {

        $customers = DB::table('users')->get();
        return view('cms.customers.all_customers', compact('customers'));
    }
    //End:: Admin All Customers

    

    

    

    

    

    

    
    

    

    
}
