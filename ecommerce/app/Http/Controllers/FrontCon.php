<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;


class FrontCon extends Controller
{
    
//Begin:: sms function
  public  function send_sms_api($msg,$number) {
        $number = preg_replace('#[ -]+#', '', $number);
		$number = preg_replace('#[=]+#', '', $number);
        if(strlen($number)==10 || strlen($number)==13){
			$number = "0".$number; 
		}
        $msg = str_replace("<br>","\n",$msg);
        $msg = strip_tags($msg);
        $url = "https://esms.mimsms.com/smsapi";
        $data = [
            "api_key" => "C200839760cca9b9942376.05627003",
            "type" => "text",
            "contacts" => $number,
            "senderid" => "8809612436500",
            "msg" => $msg,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
}
//End:: sms function

    
    
    
    public function Test(){
        return view('user.pages.test');
    }

    // Begin:: Check coupon Code
    public function checkcouponCode(){
        $code = $_GET['code'];
        $subtotal = $_GET['subtotal'];
        $couponSts = DB::table('promo_codes')->where('code', $code)->first();
        if(!empty($couponSts->id)){
            $expDate = date_create($couponSts->expire_date);
            $active = $couponSts->active;
            $today = date_create(date("Y-m-d"));
            $diff= date_diff($today, $expDate);
            $minimum_buy = $couponSts->m_buy_amount;

            if($diff->format("%R%a") < 0 || $active != 1) {
                $sts = [
                    'status' => 'not',
                    'reason' => '⚠️ Coupon is deactive'
                ];
                return response()->json($sts);
            }
            else if($subtotal < $minimum_buy){
                $sts = [
                    'status' => 'not',
                    'reason' => "⚠️ Need to buy minimu $minimum_buy Tk product",
                ];
                return response()->json($sts);
            }
            else {
                $disType = $couponSts->discount_type;
                Cookie::queue(Cookie::make('coupon_id', $couponSts->id, 25));
                $sts = [
                    'status' => 'yes',
                    'd_amount' => $couponSts->d_amount,
                    'd_max_am' => $couponSts->max_d_amount,
                    'dtype' => $disType,
                    'minimum_buy_am' => $minimum_buy,
                    'couponID' => $couponSts->id,

                ];
                return response()->json($sts);
            }
 

        }
        else {
            $sts = [
                'status' => 'not',
                'reason' => '⚠️ Invalid Coupon Code'
            ];
            return response()->json($sts);
        }
        
    }
    // End:: Check coupon Code

    // Begin:: send OTP
    public function sendotp(){
        $otp = $_GET['otp_code'];
        $number = $_GET['number'];
        $data = self::send_sms_api("Your Security key is ".$otp."<br>This Security key will be expired within 5 minutes",$number);
        if($data){
            Cookie::queue(Cookie::make('user_otp', $otp, 5));
        }
        return $data;
    }
    // End:: send OTP


    //Begin::User Register
    public function UserRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|max:255',
            'password' => 'required|confirmed|min:5',

        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['password'] = Hash::make($request->password);
        $data['active'] = 'pending';
        $data['created_at'] = Carbon::now();

        $wallteOffer = DB::table('admin_wallets')
                     ->where([
                        ['type', '=', 'registration'],
                        ['active', '=', 1]
                     ])
                     ->latest()
                     ->first();
        
        if(!empty($wallteOffer->id)){
            $date = date("Y-m-d");
            $today = strtotime($date);
            $dbStartDate = $wallteOffer->start_date;
            $Qstart_date = strtotime($dbStartDate);
            $exp_date = strtotime($wallteOffer->exp_date);

            if($today >= $Qstart_date && $today <= $exp_date){
               if($wallteOffer->point_or_tk == 'point'){
                    $data['point'] = $wallteOffer->price_amount;
               }
               else {
                $data['balance'] = $wallteOffer->price_amount;
               }
            }
        }
        

        
        DB::table('users')->insert($data);

        $otp = rand(100000,199999);
        $number = $request->phone;
        $data = self::send_sms_api("Your Security key is ".$otp."<br>This Security key will be expired within 5 minutes",$number);
        if($data){
            Cookie::queue(Cookie::make('user_otp', $otp, 5));
        }

        return Redirect('/user/otp/'.$request->phone);
        
    }
    //End::User Register

    //Begin:: otp v page
    public function OTPVpage($phone){
        $checkUser = DB::table('users')
        ->where('phone', $phone)
        ->first();

        if($checkUser){
            $dbPhone = $checkUser->phone;
            $activeSts = $checkUser->active;
            if($activeSts == 'pending'){
                return view('user.pages.account.otp_code', compact('dbPhone'));
            }
            else {
                return redirect()->back()->with('notAllow', 'Phone number is Verified. Do not need to verify again!');
            }
            
        }
        else {
            return redirect()->back()->with('notAllow', 'Phone number is invalid!');
        }
        
    }
    //End:: otp v page

    // Begin:: Verify Account by OTP code
    public function VerifyOTP(Request $request){
        $request->validate([
            'phone' => 'required',
            'otp' => 'required',
        ]);

        $storedOTP = Cookie::get('user_otp');
        if($storedOTP == $request->otp){
            $data = array();
            $data['active'] = 'active';
            $data['updated_at'] = Carbon::now();
            
            DB::table('users')->update($data);
            return Redirect('/');
        }
        else {
            $request->session()->flash('otpNOTmatched');
            return Redirect()->back();
        }

    }
    // End:: Verify Account by OTP code

    //Begin:: User Login 
    public function UserLogin(Request $request){
        $email_or_phone = $request->email_or_phone;
        $password =   $request->password;
        

        $result = DB::table('users')
        ->where(['email'=>$email_or_phone])
        ->orWhere('phone', $email_or_phone)
        ->first();

        if(!empty($result->phone)){

            if($result->password == '') {
                $dbPhone = $result->phone;
                return redirect('update-password/'.$dbPhone);
            }

            if(Hash::check($password, $result->password)) {
                if($result->active == 'active'){
                    $cTime = 3000;
                    Cookie::queue(Cookie::make('user_id', $result->id, $cTime));
                    Cookie::queue(Cookie::make('user_name', $result->name, $cTime));
                    return redirect('/')->with('userSuccess', 'Login Successfully');
                }
                else {
                    $dbPhone = $result->phone;
                    $otp = rand(100000,199999);
                    $number = $result->phone;
                    $data = self::send_sms_api("Your Security key is ".$otp."<br>This Security key will be expired within 5 minutes",$number);
                    if($data){
                        Cookie::queue(Cookie::make('user_otp', $otp, 5));
                    }
                    return view('user.pages.account.otp_code', compact('dbPhone'));
                }
            } else {
                return redirect()->back()->with('notAllow', 'Wrong User Information!');
            }
        }
        else {
            return redirect()->back()->with('notAllow', 'Wrong User Information!');
        }
    }
    //End:: User Login 

    //Begin::User password set and reset otp page
    public function UserPassResetPage($Uinfo) {
        $result = DB::table('users')
        ->where(['email'=>$Uinfo])
        ->orWhere('phone', $Uinfo)
        ->first();

        if(!empty($result->phone)){ 
            $userPhone = $result->phone;
            if(empty(Cookie::get('user_otp'))) {
                $otp = rand(100000,199999);
                $number = $result->phone;
                $data = self::send_sms_api("Your Security key is ".$otp."<br>This Security key will be expired within 5 minutes",$number);
                if($data){
                    Cookie::queue(Cookie::make('user_otp', $otp, 5));
                }
            }
            return view('user.pages.account.password_reset', compact('userPhone'));
        }
        else {
            return redirect()->back()->with('notAllow', 'Wrong User Information!');
        }
        
    }
    //End::User password set and reset otp page

    //Begin:: User password update Step one: first phone number or email check
    public function UserPassUpdate_step_one(Request $request) {
        $request->validate([
            'userInfo' => 'required',
        ]);

        $info = $request->userInfo;
        return redirect('update-password/'.$info);
    }
    //End:: User password update Step one: first phone number or email check

    //Begin::User password set and reset Confirm
    public function UserPassResetConfirm(Request $request) {
        $request->validate([
            'password' => 'required|confirmed|min:5',
        ]);

        $userPhone = $request->phone;

        $storedOTP = Cookie::get('user_otp');
        if($storedOTP == $request->otp){
            $data = array();
            $data['password'] = Hash::make($request->password);
            $data['active'] = 'active';
            $data['updated_at'] = Carbon::now();
            
            DB::table('users')->where('phone', $userPhone)->update($data);

            $userInfo = DB::table('users')->where('phone', $userPhone)->first();
            $cTime = 3000;
            Cookie::queue(Cookie::make('user_id', $userInfo->id, $cTime));
            Cookie::queue(Cookie::make('user_name', $userInfo->name, $cTime));
            return redirect('/')->with('userSuccess', 'Password Set Successfully');
        }
        else {
            $request->session()->flash('otpNOTmatched');
            return Redirect()->back();
        }

    }
    //End::User password set and reset Confirm

    // Begin:: User Logout
    public function UserLogout(){
        
        setcookie('user_id', '' , time() - 3600, "/");
        setcookie('user_name', '' , time() - 3600, "/");
        return redirect('/')->with('userSuccess', 'Logout Successfully');
    }
    // End:: User Logout

    // Begin:: MyAccount page
    public function MyAccountPage(){
        return view('user.pages.account.myaccount');
    }
    // End:: MyAccount page

    // Begin:: User All Orders
    public function UserAllOrders(){
        $customerOrder = 1;
        return view('user.pages.account.myaccount', compact('customerOrder'));
    }
    // End:: User All Orders

    
    // Begin:: Edit Account page
    public function UserEditAccount(){
        $editprofile = 1;
        return view('user.pages.account.myaccount', compact('editprofile'));
    }
    // End:: Edit Account page
    
    // Begin:: Update User Profile
    public function UpdateUserProfile(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'district' => 'required',
            'checkoutThana' => 'required',
            'address' => 'required',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['district'] = $request->district;
        $data['thana'] = $request->checkoutThana;
        $data['address'] = $request->address;
        $data['updated_at'] = Carbon::now();

        DB::table('users')->where('id', $id)->update($data);
        return Redirect()->route('user.myaccount')->with('userSuccess', 'Profile Update Successfully');;
        
    }
    // End:: Update User Profile


    // Begin:: Convert Point To tk
    public function ConvertPointtoTK() {
        $userID = Cookie::get('user_id');
        $userQ = DB::table('users')->where('id', $userID)->first();
        $shopSQ = DB::table('shop_settings')->first();

        $minimum_point_to_convert = $shopSQ->minimum_point_to_convert;
        
        $userPoint = $userQ->point;
        if($userPoint >= $minimum_point_to_convert) {
            $convert_rate = $shopSQ->point_to_tk_convert_rate;
            $converted_tk = $convert_rate*$userPoint;
            $userExistBl = $userQ->balance+0;
            $currentBl = $userExistBl + $converted_tk;
            $data = array();
            $data['point'] = 0;
            $data['balance'] = $currentBl;
            DB::table('users')->where('id', $userID)->update($data);
            return redirect()->back()->with('userSuccess', 'Point To Tk Convert Successfully.');
        }
        else {
            $needPoint = $minimum_point_to_convert - $userPoint;
            return redirect()->back()->with('notAllow', 'Sorry! You Need '.$needPoint.' More Points To Convert TK.');
        }
    }
    // End:: Convert Point To tk

    //Begin:: User Checkout
    public function UserCheckout(Request $request) {

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        if(isset($cart_data)) {
            $shipping_id = Cookie::get('shipping_id');
            $shipQ = DB::table('shipping_charges')->where('id', $shipping_id)->first();
    
            $shop_settingQ = DB::table('shop_settings')->first();
    
            $couponID = Cookie::get('coupon_id');
            $couponQ = DB::table('promo_codes')->where('id', $couponID)->first();
    
            $payment_methods = DB::table('payment_methods')->get();
    
            return view('user.pages.checkout.checkout', compact('cart_data', 'couponQ', 'shipQ', 'shop_settingQ', 'payment_methods'));
        }
        else {
            return redirect()->back()->with('notAllow', 'Sorry! Your cart is empty, can not access checkout.');
        }
        
        
    }
    //End:: User Checkout


    //Begin:: Checkout Phone Number Check
    public function CheckoutPhoneNumberCheck() {
        $phone = $_GET['phone'];
        $checkPhone = DB::table('users')->where('phone', $phone)->first();
        if(!empty($checkPhone->id)) {
            $sts = [
                'status' => 'yes',
                'reason' => 'Sorry! This Phone is used.'
            ];
            return response()->json($sts);
        }
        else {
            $sts = [
                'status' => 'no',
            ];
            return response()->json($sts);
        }
    }
    //End:: Checkout Phone Number Check

    //Begin:: Checkout Phone Number Check
    public function CheckoutEmailCheck() {
        $email = $_GET['email'];
        $checkEmail = DB::table('users')->where('email', $email)->first();
        if(!empty($checkEmail->id)) {
            $sts = [
                'status' => 'yes',
                'reason' => 'Sorry! This Email is used.'
            ];
            return response()->json($sts);
        }
        else {
            $sts = [
                'status' => 'no',
            ];
            return response()->json($sts);
        }
        
    }
    //End:: Checkout Phone Number Check


    //Begin:: Find District ID To Thana for Checkout page ajax
    public function FindDistrictIDtoThanaAjax($dID){
        $thana = DB::table('shipping_sub_areas')->where('ship_id', $dID)->get();
        return response()->json($thana);
    }
    //End:: Find District ID To Thana for Checkout page ajax


    // Begin:: Confirm Order
    public function Confrim_order(Request $request) {
       // return "paul";
        $user_log_sts = $request->user_loggedin;
        $user_id = Cookie::get('user_id');
        if($user_log_sts == 0 && empty($user_id)){
            $request->validate([
                'email' => 'required|unique:users|max:255',
                'phone' => 'required|unique:users|max:255',
                'shippingID' => 'required',
            ],
            [
                'shippingID.required' => 'Shipping Address is required!',
            ]
        );

            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['district'] = $request->district;
            $data['thana'] = $request->checkoutThana;
            $data['address'] = $request->address;
            $data['active'] = 'pending';
            $data['created_at'] = Carbon::now();

            DB::table('users')->insert($data);
            
            //return $user_id;
        }
        else {
            $request->validate([
                'shippingID' => 'required',
            ],
            [
                'shippingID.required' => 'Shipping Address is required!',
            ]
        );
        }
        $userQ = DB::table('users')->where('phone', $request->phone)->first();
        $user_id = $userQ->id;
        $userExistPoints = $userQ->point;
        $userExistTk = $userQ->balance;
        $userPhone = $userQ->phone;

        
        $count_orders = DB::table('orders')->count();
        $total_orders = $count_orders + 1;
        $invID = date("dmy").$total_orders;

        $orders_data = array();
        $orders_data['invID'] = $invID;
        $orders_data['userID'] = $user_id;
        $orders_data['userPhone'] = $request->phone;
        $orders_data['order_note'] = $request->order_note;
        $orders_data['shipping_address'] = $request->shipping_address;
        $orders_data['ship_to_another_address'] = $request->ship_to_another_address;
        $orders_data['subtotal'] = $request->subtotal;
        $orders_data['shippingID'] = $request->shippingID;
        $orders_data['shippingCrg'] = $request->shippingCrg;
        $orders_data['couponDiscount'] = $request->couponDiscount;
        $orders_data['wallet_bl'] = $request->wallet_bl;
        $orders_data['payment_method'] = $request->paymentMethod;
        $orders_data['transactionID'] = $request->transactionID;
        $orders_data['date'] = date('Y-m-d');
        $orders_data['order_status'] = 'pending';
        $orders_data['created_at'] = Carbon::now();
        

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $p_data) {
            $product_data = array();
            $product_data['invID'] = $invID;
            $product_data['pid'] = $p_data['item_id'];
            $product_data['qty'] = $p_data['item_quantity'];
            $product_data['price'] = $p_data['item_price'];
            $product_data['is_variable'] = $p_data['pType'];
            $product_data['created_at'] = Carbon::now();

            if($p_data['pType'] == 'variation') {
                $a = 0;
                $b = 1;
                for($a; $a<$b; $a++){ 
                    if(!empty($p_data['atID'.$a])){
                        $variData = array();
                        $variData['invID'] = $invID;
                        $variData['pid'] = $p_data['item_id'];
                        $variData['variationID'] = $p_data['atID'.$a];
                        $variData['variation_name'] = $p_data['atN'.$a];
                        $variData['variation'] = $p_data['atV'.$a];
                        $variData['created_at'] = Carbon::now();
                        
                        DB::table('orders_product_variations')->insert($variData);
                    }
                    else {
                        break;
                    }
                    $b++;
                }
            }

            DB::table('orders_products')->insert($product_data);
        }

        DB::table('orders')->insert($orders_data);

        // Wallet offer check 
        $pointPrice = 0;
        $tkPrice = 0;
        if(!empty($request->wallet_bl)) {
            $used_wallet = $request->wallet_bl;
        }
        else {
            $used_wallet = 0;
        }
        $wallteOffer = DB::table('admin_wallets')
                     ->where([
                        ['type', '=', 'sell'],
                        ['active', '=', 1]
                     ])
                     ->latest()
                     ->first();
        
        if(!empty($wallteOffer->id)){
            $date = date("Y-m-d");
            $today = strtotime($date);
            $dbStartDate = $wallteOffer->start_date;
            $Qstart_date = strtotime($dbStartDate);
            $exp_date = strtotime($wallteOffer->exp_date);
            $maximumBuy = $wallteOffer->maximum_buy;

            if($today >= $Qstart_date && $today <= $exp_date && $maximumBuy <= $request->subtotal){
               if($wallteOffer->point_or_tk == 'point'){
                    $pointPrice = $wallteOffer->price_amount;

               }
               else {
                    $tkPrice = $wallteOffer->price_amount;
               }
            }
        }
        // Wallet offer check End

        // Update User Data Start
            $userCurrentP = $userExistPoints + $pointPrice;
            $userCTK = $userExistTk - $used_wallet + $tkPrice;
            $userUdata = array();
            $userUdata['point'] = $userCurrentP;
            $userUdata['balance'] = $userCTK;
            DB::table('users')->where('id', $user_id)->update($userUdata);
        //End:: Update User Data

        setcookie('shopping_cart', '' , time() - 3600, "/");
        setcookie('coupon_id', '' , time() - 3600, "/");

        $shopSQ = DB::table('shop_settings')->first();
        $shop_name = $shopSQ->shop_name;

        $smsMsg = "Dear ".$request->name.". Your order has been placed successfully. Your Order ID: ".$invID." Regards ".$shop_name;
        $smsData = self::send_sms_api($smsMsg,$userPhone);
        
        return redirect('/orders/'.$invID);
        
        
    }
    // End:: Confirm Order

    //Begin:: User Orders
    public function UserOrders($invID){
        $ordersQ = DB::table('orders')
                    ->join('shipping_charges', 'orders.shippingID', 'shipping_charges.id')
                    ->select('orders.*', 'shipping_charges.name')
                    ->where('orders.invID', $invID)
                    ->first();

        $user_id = Cookie::get('user_id');

        if(!empty($ordersQ->id)) {
            return view('user.pages.orders.orderpage', compact('ordersQ', 'user_id'));
        }
        else {
            return redirect()->back()->with('notAllow', 'Wrong Order information!');
        }
        
        
    }
    //End:: User Orders

    //Begin:: Set Shipping Cookie
    public function SetShippingCookie() {
        $id = $_GET['shipID'];
        $amount = $_GET['amount'];
        Cookie::queue(Cookie::make('shipping_id', $id, 60));
        Cookie::queue(Cookie::make('shipping_crg', $amount, 60));
    }
    //End:: Set Shipping Cookie

    //Begin::Track Order
    public function TrackOrder(Request $request){
        $orderID = $request->orderID;
        $order = '';
        if(!empty($orderID)) {
            $order = DB::table('orders')
                    ->join('users', 'orders.userID', 'users.id')
                    ->select('orders.*', 'users.name')
                    ->where('orders.invID', $orderID)
                    ->first();

            if(!empty($order->invID)) {
                return view('user.pages.orders.track_order', compact('order'));
            }
            else {
                return redirect()->back()->with('notAllow', 'Sorry! Order ID is invalid.');
            }

        }
        else {
            return view('user.pages.orders.track_order', compact('order'));
        }
        
    }
    //End::Track Order

    //Begin::ORder Cancel by User
    public function OrderCancelByUser(Request $request) {
        
        $invID = $request->invID;
        $cancel_reason = $request->order_cancel_reason;
        if($cancel_reason != ''){
            //return $cancel_reason;
            $data = array();
            $data['order_status'] = 'canceled';
            $data['order_cancel'] = 1;
            $data['cancel_by'] = 'user';
            $data['order_cancel_reason'] = $cancel_reason;
            $data['updated_at'] = Carbon::now();
            DB::table('orders')-> where('invID', $invID) ->update($data);
            return redirect('/')->with('userSuccess', 'Order Canceled Successfully.');
            
        }
        else {
            return redirect()->back()->with('notAllow', 'Please Select A Cancel Reason!');
        }
        
        
    }

    //End::ORder Cancel by User

    //Begin:: Extra

    //About us
    public function AboutUS() {

    }
    // About us

    public function contact_us() {
        $shop_s = DB::table('shop_settings')->first();
        return view('user.pages.extra.contact_us', compact('shop_s'));
    }

    public function Terma_and_conditions() {
        $shop_s = DB::table('shop_settings')->first();
        return view('user.pages.extra.terms_and_conditions', compact('shop_s'));
    }
    public function Mission_vission() {
        $shop_s = DB::table('shop_settings')->first();
        return view('user.pages.extra.mission_vission', compact('shop_s'));
    }

    public function privacy_policy() {
        $shop_s = DB::table('shop_settings')->first();
        return view('user.pages.extra.privacy_policy', compact('shop_s'));
    }

    
    //End:: Extra

    

   

    

  
    


    

    

    
    

}
