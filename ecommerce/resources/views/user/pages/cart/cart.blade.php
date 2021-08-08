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

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                @if(!empty($cart_data))
                @php $total="0" @endphp
                <div class="shopping-cart">
                    <div class="shopping-cart-table">
                        <div class="table-responsive">
                            <div class="col-md-12 text-right mb-3">
                                <!-- <a href="javascript:void(0)" class="clear_cart font-weight-bold">Clear Cart</a> -->
                            </div>
                            <table class="table table-bordered my-auto  text-center">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Product Name</th>
                                        <th class="cart-price">Price</th>
                                        <th class="cart-qty">Quantity</th>
                                        <th class="cart-total">Grandtotal</th>
                                        <th class="cart-romove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="my-auto">
                                    @foreach ($cart_data as $data)
                                    <tr class="cartpage" id="cartTr{{$data['secPID']}}">

                                        <td class="cart-product-name-info" style="text-align: left;">
                                            <h4 class='cart-product-description'>
                                                <a href="javascript:void(0)">{{ $data['item_name'] }}</a><br>

                                                @if($data['pType'] == 'variation')
                                                @php
                                                $a = 0;
                                                $b = 1;
                                                for($a; $a<$b; $a++){ if(!empty($data['atID'.$a])){ //echo
                                                    $data['atID'.$a]; @endphp <span
                                                    style="font-size: 12px; color: #F50057;">{{$data['atN'.$a]}}:
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
                                            </h4>
                                        </td>
                                        <td class="cart-product-sub-total">
                                            <span
                                                class="cart-sub-total-price">{{ number_format($data['item_price'], 2) }}</span>
                                        </td>
                                        <td width="15%" class="cart-product-quantity" id="cart-product-quantity">
                                            <div class="d-flex flex-row align-items-center qty">
                                                <i onclick="update_cart_qty_in_sideCart_and_cart_Minus({{ $data['secPID'] }})" class="fa fa-minus text-danger cartPlus_minus"></i>
                                                    <input type="number" onkeyup="changeCartQty({{ $data['secPID'] }})"
                                                onchange="changeCartQty({{ $data['secPID'] }})" class="qty-input cartQtyInputBox inputTypeNumberQ" value="{{ $data['item_quantity'] }}" min="1" id="cartQty{{ $data['secPID'] }}" step=any> 
                                                <i onclick="update_cart_qty_in_sideCart_and_cart_plus({{ $data['secPID'] }})" class="fa fa-plus text-success cartPlus_minus"></i>
                                            </div>
                                        </td>
                                        <td class="cart-product-grand-total">
                                            @php $indGtotal = 0 + ($data['item_quantity'] * $data['item_price']) @endphp
                                            <span id="indGtotal{{$data['secPID']}}"
                                                class="cart-grand-total-price indCartGrndTotal">{{ $indGtotal }}</span>
                                        </td>
                                        <td style="font-size: 20px;">
                                            <button type="button" onclick="DeleteCartRow({{$data['secPID']}})"
                                                class="btn btn-outline-danger btn-sm">
                                                <li class="fa fa-trash-o"></li>
                                            </button>
                                        </td>
                                        @php $total = $total + ($data["item_quantity"] * $data["item_price"]) @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- /table -->
                        </div>
                    </div><!-- /.shopping-cart-table -->
                    <div class="row">

                        <div class="col-md-7 col-sm-12 estimate-ship-tax">
                            <div>

                                @php

                                $shippingCharges = DB::table('shipping_charges')->orderBy('name', 'asc')->get();
                                $shipping_id = Cookie::get('shipping_id');
                                $shipping_crg = Cookie::get('shipping_crg');
                                if(empty($shipping_id)) {
                                    $shipping_id = 0;
                                    $shipping_crg = 0;
                                }

                                $ship_id_am = $shipping_id.",".$shipping_crg;
                                
                                @endphp

                            </div>
                        </div><!-- /.estimate-ship-tax -->
                        <div class="col-md-5 col-sm-12 mt-2">
                            <div class="cart-shopping-total card">
                                <div class="card-header text-center pt-1 pb-1 text-light"
                                    style="border-radius: 5px; background-color: #F50057;">
                                    <h3>Order Summary</h3>
                                </div>
                                <form action="{{ route('user.checkout') }}" method="post">
                                    @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <h6 class="cart-subtotal-name">Subtotal</h6>
                                        </div>
                                        <div class="col-md-6 col-6" style="text-align: right;">
                                            <h6 class="cart-subtotal-price">৳
                                                <span id="cart_page_subtotal" class="cart-grand-price-viewajax"
                                                    style="padding-right: 20px;">{{$total}}</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-3">
                                            <h6 class="cart-subtotal-name">Shipping Fee</h6>
                                        </div>
                                        <div class="col-md-5 col-5">
                                            <input type="hidden" id="shippingchargeHi" value="{{$shipping_crg}}" name="">
                                            <select id="shippingAreaChange" onchange="ShippingCng()" name="shippingCharge" class="form-select js-example-basic-single">
                                                <option value="0,0" >-- Shipping Area --</option>
                                                @foreach($shippingCharges as $ship)
                                                @php( $ship_id_am_db = $ship->id.",".$ship->amount)
                                                <option @if($ship_id_am_db == $ship_id_am) selected @endif value="{{$ship->id}},{{$ship->amount}}">{{$ship->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-4" style="text-align: right;">
                                            <h6 class="cart-subtotal-price">৳
                                                <span id="shippingChargeshow" class="cart-grand-price-viewajax"
                                                    style="padding-right: 20px;">{{$shipping_crg}}</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <div id="couponCodeDiv" class="input-group">
                                                <input type="text" id="couponCode" class="form-control" placeholder="Coupon Code"
                                                    aria-label="Input group example" aria-describedby="btnGroupAddon2">
                                                <div class="input-group-prepend">
                                                    <span onclick="ApplyCoupon()" class="btn btn-secondary" id="">Apply</span>
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
                                        <input type="hidden" value="0" id="couponDiscountValue" name="">
                                            <h6 class="cart-subtotal-price text-danger">৳
                                                <span id="couponDiscountValue_show" class="cart-grand-price-viewajax"
                                                    style="padding-right: 20px; text-decoration: line-through;">0</span>
                                            </h6>
                                            
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <h6 class="cart-grand-name">Grand Total</h6>
                                        </div>
                                        <div class="col-md-4 col-4" style="text-align: right;">
                                            <h6 class="cart-grand-price">৳
                                                <span id="cart_grandTotal" style="padding-right: 20px;" class="cart-grand-price-viewajax">{{ number_format($total + $shipping_crg, 2) }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-7">
                                            <a href="{{ route('shop') }}"
                                                class="btn btn-upper btn-warning btn-sm outer-left-xs">Continue Shopping</a>
                                        </div>
                                        <div class="col-md-6 col-5">
                                            <div class="cart-checkout-btn text-center">
                                                <button type="submit" class="btn btn-success btn-sm btn-block checkout-btn">CHECKOUT</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div><!-- /.shopping-cart -->
                @else
                <div class="row">
                    <div class="col-md-12 mycard py-5 text-center">
                        <div class="mycards">
                        <img style="width: 300px; border-radius: 20px;" src="{{asset('frontend/img/empty_cart.png')}}" alt=""><br>
                            <a href="{{ route('shop') }}"
                            class="btn btn-rounded mt-2">Continue Shopping</a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div> <!-- /.row -->
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
