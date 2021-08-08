@php $subtotal = 0; @endphp
<ul class="cart_product">
    @foreach ($cart_data as $data)
    <li>
        <div class="media">
            <div class="media-body">

                <div class="row">
                    <div class="col-md-12">
                        <p class="text-primary">{{ $data['item_name'] }}</p>
                        @if($data['pType'] == 'variation')
                        @php
                        $a = 0;
                        $b = 1;
                        for($a; $a<$b; $a++){ if(!empty($data['atID'.$a])){ //echo $data['atID'.$a]; @endphp <span
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-4">
                        <p style="margin-top: 5px;">৳ {{number_format($data['item_price'], 2)}}</p>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="d-flex flex-row align-items-center qty">
                            <i onclick="update_cart_qty_in_sideCart_and_cart_Minus({{ $data['secPID'] }})" class="fa fa-minus text-danger cartPlus_minusSide"></i>
                                <input type="number" onkeyup="changeCartQty({{ $data['secPID'] }})"
                            onchange="changeCartQty({{ $data['secPID'] }})" class="qty-input cartQtyInputBoxSide inputTypeNumberQ" value="{{ $data['item_quantity'] }}" min="1" id="cartQty{{ $data['secPID'] }}" step=any> 
                            <i onclick="update_cart_qty_in_sideCart_and_cart_plus({{ $data['secPID'] }})" class="fa fa-plus text-success cartPlus_minusSide"></i>
                        </div>
                    </div>
                    <div class="col-md-2 col-2 text-right">
                        <i onclick="DeleteCartRow({{ $data['secPID'] }})" class="fa fa-trash-o text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </li>
    @php $subtotal = $subtotal + ($data['item_price']*$data['item_quantity']) @endphp
    @endforeach
</ul>
<ul class="cart_total">
    <li>
        <div class="total">
            subtotal<span id="right_side_cart_subtotal">{{ number_format($subtotal, 2) }}</span>
        </div>
    </li>
    <li>
        <div class="buttons">
            <a href="{{route('product_cart')}}" class="btn btn-solid btn-sm">view cart</a>
            <a href="{{route('user.checkout')}}" class="btn btn-solid btn-sm ">checkout</a>
        </div>
    </li>
</ul>
