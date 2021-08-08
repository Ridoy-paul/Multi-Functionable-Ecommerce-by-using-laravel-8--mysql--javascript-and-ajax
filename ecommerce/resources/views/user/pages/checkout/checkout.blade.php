@extends('user.user_master')
@section('user_content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            </div>
        </div>
    </div>
</section>

@php

$userID = Cookie::get('user_id');
$userQ = DB::table('users')->where('id', $userID)->first();
$userWbl = optional($userQ)->balance+0;

if(!empty($userQ->id)){
$userL = 1;
}
else {
$userL = 0;
}
$shippingCharges = DB::table('shipping_charges')->orderBy('name', 'asc')->get();
$total = 0;
$discount_amount = 0;
$shipping_charge = 0;
@endphp

<section class="section">
    <div class="container">
    <form action="{{route('confirm.order')}}" method="post">
    @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><b>CHECKOUT INFORMATION</b></h4>
                                <input type="hidden" name="user_loggedin" id="checkLoggedin" value="{{$userL}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    @if($userL == 1)
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> পুরো নাম/Full
                                        Name</label>
                                    <input readonly type="text" id="" class="form-control" name="name"
                                        value="{{ optional($userQ)->name }}" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> মোবাইল
                                        নাম্বার/Mobile No</label>
                                    <input type="text" readonly minlength="11" maxlength="11" id="CheckoutPhone"
                                        class="form-control" value="{{optional($userQ)->phone}}" name="phone" required />
                                    <span class="text-danger" id="checkPhoneWarning"></span>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> ইমেল/Email</label>
                                    <input type="email" readonly id="CheckoutEmail" class="form-control"
                                        value="{{optional($userQ)->email}}" name="email" required />
                                    <span class="text-danger" id="checkEmailWarning"></span>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                @php
                                    $user_dis = DB::table('shipping_charges')->where('id', $userQ->district)->first();
                                    $user_sub_dis = DB::table('shipping_sub_areas')->where('id', $userQ->thana)->first();
                                        
                                    
                                @endphp
                                <div class="form-group">
                                    <div id="order_address_div">
                                        <label for="first-name-column"><span class="text-danger">*</span>Shipping Address</label>
                                        <textarea class="form-control" id="order_address" name="shipping_address" rows="2">{{optional($userQ)->address}}. {{optional($user_sub_dis)->shipping_sub_name}}, {{optional($user_dis)->name}}</textarea>
                                    </div>
                                    <input class="form-check-input" type="checkbox" value="" id="ship_to_another_address_check">
                                    <label class="form-check-label text-primary" for="ship_to_another_address_check">Ship to another address</label>
                                </div>
                            </div>
                        </div>
                    @else 
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> পুরো নাম/Full
                                        Name</label>
                                    <input type="text" id="" class="form-control" name="name"
                                        value="" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> মোবাইল
                                        নাম্বার/Mobile No</label>
                                    <input type="text" minlength="11" maxlength="11" id="CheckoutPhone"
                                        class="form-control" value="" name="phone" required />
                                    <span class="text-danger" id="checkPhoneWarning"></span>
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> ইমেল/Email</label>
                                    <input type="email" id="CheckoutEmail" class="form-control"
                                        value="" name="email" required />
                                    <span class="text-danger" id="checkEmailWarning"></span>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> জেলা /
                                        District</label>
                                    <select id="checkoutDistrict" name="district" class="form-select js-example-basic-single" required>
                                        <option value="0">-- Select District --</option>
                                        @foreach($shippingCharges as $ship)
                                        <option value="{{$ship->id}}">{{$ship->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> এরিয়া /
                                        Area</label>
                                    <select id="checkoutThanas" name="checkoutThana" class="form-select js-example-basic-single" required>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first-name-column"><span class="text-danger">*</span> পুরো ঠিকানা/Full
                                        Address</label>
                                    <input type="text" class="form-control" id="full_address" name="address" rows="2" required></input>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div id="order_address_div">
                                        <label for="first-name-column"><span class="text-danger">*</span>Shipping Address</label>
                                        <textarea class="form-control" id="order_address" name="shipping_address" rows="2"></textarea>
                                    </div>
                                    <input class="form-check-input" type="checkbox" value="" id="ship_to_another_address_check">
                                    <label class="form-check-label text-primary" for="ship_to_another_address_check">Ship to another address</label>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="col-md-12 d-none" id="ship_to_another_address">
                            <div class="form-group">
                                <label for="first-name-column"><span class="text-danger">*</span>Ship To Another Address</label>
                                <textarea class="form-control" id="" name="ship_to_another_address" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first-name-column">অর্ডার নোট/Order Note (optional)</label>
                                    <textarea class="form-control" id="" name="order_note" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h5><b>Checkout Summery</b></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>QTY</th>
                                    <th>SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="my-auto">
                                @foreach ($cart_data as $data)
                                <tr class="cartpage" id="cartTr{{$data['secPID']}}">

                                    <td class="cart-product-name-info" style="text-align: left;">
                                        <p class='cart-product-description'>
                                            <a href="javascript:void(0)">{{ $data['item_name'] }}</a><br>

                                            @if($data['pType'] == 'variation')
                                            @php
                                            $a = 0;
                                            $b = 1;
                                            for($a; $a<$b; $a++){ if(!empty($data['atID'.$a])){ //echo $data['atID'.$a];
                                                @endphp <span style="font-size: 12px; color: #F50057;">
                                                {{$data['atN'.$a]}}:
                                                {{$data['atV'.$a]}},</span>&nbsp;
                                                @php
                                                }
                                                else {
                                                break;
                                                }
                                                $b++;
                                                }

                                                @endphp
                                                @endif
                                        </p>
                                    </td>
                                    
                                    <td class="cart-product-quantity">{{ $data['item_quantity'] }}</td>
                                    <td class="cart-product-grand-total">
                                        @php $indGtotal = 0 + ($data['item_quantity'] * $data['item_price']) @endphp
                                       {{ number_format($indGtotal, 2) }}
                                    </td>

                                    @php $total = $total + ($data["item_quantity"] * $data["item_price"]) @endphp
                                </tr>
                                @endforeach
                            </tbody>
                        </table><!-- /table -->
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <h4 class="cart-subtotal-name">Subtotal</h4>
                            </div>
                            <input type="hidden" name="subtotal" value="{{$total}}">
                            <div class="col-md-6 col-6" style="text-align: right;">
                                <h6 class="cart-subtotal-price">৳
                                    <span id="cart_page_subtotal" class="cart-grand-price-viewajax"
                                        style="padding-right: 20px;">{{$total}}</span>
                                </h6>
                            </div>
                        </div>
                        <hr>
                        <!-- Shipping Start -->
                        @if(!empty($shipQ->id))
                        <div class="row">
                            <div class="col-md-8 col-8">
                                <h6 class="cart-subtotal-name">Shipping Fee ( {{$shipQ->name}} )</h6>
                                <input type="hidden" id="" value="{{$shipQ->id}}" name="shippingID">
                            </div>
                            @php( $shipping_charge = $shipQ->amount )
                            <input type="hidden" id="shippingchargeHi" value="{{$shipQ->amount}}" name="shippingCrg">
                            <div class="col-md-4 col-4" style="text-align: right;">
                                <h6 class="cart-subtotal-price">৳
                                    <span id="shippingChargeshow" class="cart-grand-price-viewajax"
                                        style="padding-right: 20px;">{{$shipQ->amount}}</span>
                                </h6>
                            </div>
                        </div>
                        <hr>
                        @else
                        <div class="row">
                            <div class="col-md-3 col-3">
                                <h6 class="cart-subtotal-name">Shipping Fee</h6>
                            </div>
                            <div class="col-md-5 col-5">
                                        <input type="hidden" id="setshippingID" value="" name="shippingID">
                                        <input type="hidden" id="shippingchargeHi" value="0" name="shippingCrg">
                                <select id="shippingAreaChange" onchange="ShippingCngCheckout()" class="form-select required js-example-basic-single">
                                    <option value="0,0">-- Shipping Area --</option>
                                    @foreach($shippingCharges as $ship)
                                    <option value="{{$ship->id}},{{$ship->amount}}">{{$ship->name}}</option>
                                    @endforeach
                                </select>
                                @error('shippingID')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 col-4" style="text-align: right;">
                                <h6 class="cart-subtotal-price">৳
                                    <span id="shippingChargeshow" class="cart-grand-price-viewajax"
                                        style="padding-right: 20px;">0</span>
                                </h6>
                            </div>
                        </div>
                        <hr>
                        @endif
                        <!-- Shipping End -->

                        <!-- Coupon Discount Start -->
                        @if(!empty($couponQ->id))
                        <div class="row">
                        <?php
                            if($couponQ->discount_type == 'Fixed'){

                                $discount_amount = $couponQ->d_amount;
                             }
                             else if($couponQ->discount_type == 'Percentage'){
                          
                                $discount_amount = $couponQ->d_amount;
                                $discount_max_amount = $couponQ->max_d_amount;
                                
                                $discount_amount = ($discount_amount * $total)/100;
                                if($discount_amount > $discount_max_amount) {
                                    $discount_amount = $discount_max_amount;
                                }
                                else {
                                   $discount_amount = $discount_amount;
                                }
                          
                             }
                        ?>
                            <div class="col-md-8 col-8">
                                <span id="AppliedCoupon" class="text-success">Coupon discount</span>
                                <input type="hidden" name="couponID" value="{{$couponQ->id}}" id="couponIDforCheckout">
                            </div>

                            <div class="col-md-4 col-4" style="text-align: right;">
                            <input type="hidden" value="{{$discount_amount}}" id="" name="couponDiscount">
                                <h6 class="cart-subtotal-price text-danger">৳
                                    <span id="" class="cart-grand-price-viewajax"
                                        style="padding-right: 20px; text-decoration: line-through;">{{$discount_amount}}</span>
                                </h6>
                            </div>
                        </div>
                        <hr>
                        @else
                        <div class="row">
                            <div class="col-md-8 col-8">
                                <div id="couponCodeDiv" class="input-group">
                                    <input type="text" id="couponCode" class="form-control" placeholder="Coupon Code"
                                        aria-label="Input group example" aria-describedby="btnGroupAddon2">
                                    <div class="input-group-prepend">
                                        <span  onclick="ApplyCouponCheckout()" class="btn btn-secondary" id="">Apply</span>
                                    </div>
                                </div>
                                <span id="couponWarning" class="text-danger d-none"></span>
                                <span id="AppliedCoupon" class="text-success d-none">Coupon discount</span>

                                <input type="hidden" name="couponID" value="" id="couponIDforCheckout">
                                <input type="hidden" name="" id="couponValue" value="0">
                                <input type="hidden" name="" id="maxCValue" value="0">
                                <input type="hidden" name="" id="couponType" value="0">
                                <input type="hidden" name="" id="minimumBuyAm" value="0">
                                
                            </div>

                            <div class="col-md-4 col-4" style="text-align: right;">
                            <input type="hidden" value="0" id="couponDiscountValue" name="couponDiscount">
                                <h6 class="cart-subtotal-price text-danger">৳
                                    <span id="couponDiscountValue_show" class="cart-grand-price-viewajax"
                                        style="padding-right: 20px; text-decoration: line-through;">0</span>
                                </h6>
                                
                            </div>
                        </div>
                        <hr>
                        @endif
                        <!-- Coupon Discount End -->

                        <!-- Use User Wallet Balance Start -->
                        <input type="hidden" name="" value="{{$shop_settingQ->minimum_purchase_amount_in_tk_use_wallet_bl}}" id="maximum_wallet_use_parcent">
                        <input type="hidden" id="wallet_bl_use" value="0" name="wallet_bl">
                        @if($userL == 1 && $userWbl > 0)
                        <div class="row">
                            <div class="col-md-4 col-4">
                                <h4 class="cart-subtotal-name">Wallet Balance</h4>
                            </div>
                            <div class="col-md-4 col-4">
                                <input type="number" step=any id="main_wallet_balance" readonly value="{{$userWbl}}" class="form-control" name="userWallet_balance">
                            </div>
                            <div class="col-md-4 col-4" style="text-align: right;">
                                <span id="use_wallet_button" onclick="Use_wallet_bl('{{$userWbl}}')" class="btn btn-primary">Use</span>
                                <h6 id="wallet_bl_show_tag" class="cart-subtotal-price d-none">৳ (-)
                                    <span id="wallet_bl_used" class="cart-grand-price-viewajax"
                                        style="padding-right: 20px;">0</span>
                                </h6>
                            </div>
                        </div>
                        <hr>
                        @endif
                        <!-- Use User Wallet Balance End -->
                        <div class="row">
                            <div class="col-md-8 col-8">
                                <h4 class="cart-grand-name">Total Payable</h4>
                            </div>
                            <div class="col-md-4 col-4" style="text-align: right;">
                                <h6 class="cart-grand-price">৳
                                    <span id="checkout_grand_total" style="padding-right: 20px;" class="cart-grand-price-viewajax">{{ number_format($total+$shipping_charge-$discount_amount, 2) }}</span>
                                </h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="cart-grand-name">Payable Method :</h4>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" required type="radio" name="paymentMethod" id="cashonD" value="cashonD" >
                                    <label class="form-check-label" for="cashonD">
                                        Cash On Delivery
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                                @foreach($payment_methods as $payment_method)
                                <div class="col-md-3 col-3">
                                    <div class="form-check">
                                        <input type="hidden" value="{{$payment_method->number}}" id="num_{{$payment_method->method_name}}" name="">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="{{$payment_method->method_name}}" value="{{$payment_method->method_name}}" >
                                        <label class="form-check-label" for="{{$payment_method->method_name}}">{{$payment_method->method_name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            <hr>
                            <div class="row d-none" id="transIDrow">
                            <div class="col-md-12">
                                <div class="card-body text-center" style="border-radius: 10px; border: 1px dashed #544AF4;">
                                    <h4><b>Please use this number to pay via <span class="text-primary" id="meth_Name_and_num"></span></b></h4><hr>
                                    <input type="text" id="transactionID" name="transactionID" placeholder="Enter Your Transaction ID" class="form-control">
                                </div>
                            </div>
                            <hr>
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" required id="agreeAll">
                                <label class="form-check-label" for="agreeAll">I agree to the <a target="_blank" href="{{route('user.terms.and.conditions')}}">terms and conditions</a> and <a target="_blank" href="{{route('user.privacy.policy')}}">Privacy Policy</a></label>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <a href="{{ route('product_cart') }}"
                                    class="btn btn-upper btn-info outer-left-xs">Return Cart</a>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="cart-checkout-btn text-center">
                                    <button type="submit" class="btn btn-primary btn-block checkout-btn">Confirm Order</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> <!-- /.row -->
    </form>
    </div><!-- /.container -->
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            </div>
        </div>
    </div>
</section>

@endsection
