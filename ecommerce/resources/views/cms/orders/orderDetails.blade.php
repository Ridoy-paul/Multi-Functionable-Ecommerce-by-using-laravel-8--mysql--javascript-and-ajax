@extends('cms.cms_master')
@section('admin_content')
@php
$i = 1;
$shop_s = DB::table('shop_settings')->first();
$customer = DB::table('users')->where('id', optional($ordersQ)->userID)->first();
$products = DB::table('orders_products')
->join('products', 'orders_products.pid', 'products.id')
->select('orders_products.*', 'products.title')
->where('orders_products.invID', optional($ordersQ)->invID)
->get();

@endphp
<section class="section">
    <div class="section-header">
        <h1>Order Details</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div style="padding: 5px;">
                            <div class="row">
                                <div class="col-md-6 col-4 text-left">
                                    <img id="invoicePageLogo" src="{{asset($shop_s->logo)}}" alt="">
                                </div>
                                <div class="col-md-6 col-8" style="text-align: right;">
                                    <h2><b>{{$shop_s->shop_name}}</b></h2>
                                    <p class="font_size_small"><b>{{$shop_s->address}}</b><br><b>{{$shop_s->phone_1}}, {{$shop_s->phone_2}}<br>{{$shop_s->email}}</b></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-6" style="text-align: left;">
                                    <p>
                                        <b class="text-info">Customer Name: </b>{{$customer->name}}<br>
                                        <b class="text-info">Adderss: </b>{{$customer->address}}<br>
                                        <b class="text-info">Phone: </b>{{$customer->phone}}<br>
                                        <b class="text-info">Email: </b>{{$customer->email}}
                                    </p>
                                </div>
                                <div class="col-md-6 col-6" style="text-align: right;">
                                    <p class="font_size_small">
                                        <b class="text-info">Order Date: </b>{{date("d M, Y", strtotime($ordersQ->date))}}<br>
                                        <b class="text-info">Order Number: </b>{{$ordersQ->invID}}<br>
                                        <b class="text-danger">Order Status: </b>{{$ordersQ->order_status}}
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="padding: 10px;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">SI</th>
                                                <th scope="col">Product Title</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($products as $product)
                                            <tr>
                                                <th class="text-center">{{$i}}</th>
                                                <td>
                                                    {{$product->title}}
                                                    @if($product->is_variable == 'variation')
                                                    <br>
                                                    <?php
                                                            $variationsQ = DB::table('orders_product_variations')->where('invID', $ordersQ->invID)->where('pid', $product->pid)->get();
                                                        ?>
                                                    @foreach($variationsQ as $variation)
                                                    <span class="text-info">{{$variation->variation_name}}
                                                        {{$variation->variation}}, </span>
                                                    @endforeach


                                                    @endif
                                                </td>
                                                <td class="text-center">{{$product->qty}}</td>
                                                <td class="text-center">{{ number_format($product->price, 2)}}</td>
                                                <td class="text-center">৳
                                                    {{ number_format($product->price*$product->qty, 2)}}</td>
                                            </tr>
                                            <?php
                                                    $i++;
                                               ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-sm table-bordered">
                                        <tbody style="text-align: right;">
                                        <tr style="text-align: right;">
                                                <td style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                                                    <b>Subtotal</b>
                                                </td>
                                                <td style="text-align:right; width:100px !important;">{{ number_format($ordersQ->subtotal, 2)}}</td>
                                            </tr>
                                            <tr style="text-align: right;">
                                                <td style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                                                    <b>Shipping Fee</b>
                                                </td>
                                                <td style="text-align:right; width:100px !important;">{{ number_format($ordersQ->shippingCrg, 2)}}</td>
                                            </tr>
                                            @if(!empty($ordersQ->couponDiscount))
                                            <tr style="text-align: right;">
                                                <td style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                                                    <b>Coupon Discount</b>
                                                </td>
                                                <td style="text-align:right; width:100px !important;">{{ number_format($ordersQ->couponDiscount, 2)}}</td>
                                            </tr>
                                            @endif

                                            @if(!empty($ordersQ->wallet_bl))
                                            <tr style="text-align: right;">
                                                <td style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                                                    <b>Wallet Balance</b>
                                                </td>
                                                <td style="text-align:right; width:100px !important;">{{ number_format($ordersQ->wallet_bl, 2)}}</td>
                                            </tr>
                                            @endif

                                            @php 
                                                $subtotal = $ordersQ->subtotal;
                                                $shippingCrg = $ordersQ->shippingCrg+0;
                                                $couponDiscount = $ordersQ->couponDiscount+0;
                                                $wallet_bl = $ordersQ->wallet_bl+0;
                                                $total_payable = $subtotal + $shippingCrg - $couponDiscount - $wallet_bl;
                                            @endphp

                                            <tr style="text-align: right;">
                                                <td style="border-bottom: 1px solid white; border-left: 1px solid white; border-top: 1px solid white; text-align: right;">
                                                    <b>Total Payable</b>
                                                </td>
                                                <td style="text-align:right; width:100px !important;">{{ number_format($total_payable, 2)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                        @if($ordersQ->payment_method != 'cashonD')
                                        <h4><b>*Payment Method: </b> {{$ordersQ->payment_method}}</h4>
                                        <p><b class="text-primary">->Transantion ID: </b> {{$ordersQ->transactionID}}</p>
                                        @else
                                        <h4><b>*Payment Method: </b> Cash On Delivery</h4>
                                        @endif
                                        
                                        <h4><b>*Delivery Address: </b> {{$ordersQ->name}}</h4>
                                        <p><b>*Order Note: </b> {{$ordersQ->order_note}}</p>
                                        @if(!empty($ordersQ->ship_to_another_address))
                                        <p><b>*Ship to another address: </b> {{$ordersQ->ship_to_another_address}}</p>
                                        @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-sm btn-block">Print</button>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-warning btn-sm btn-block">Download pdf</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-12">
                                <p style="font-size: 15px;">Order Status: <b class="text-info">{{$ordersQ->order_status}}</b></p>
                                @if($ordersQ->order_status == 'canceled')
                                    <p><b>Cancel By: </b> {{$ordersQ->cancel_by}}</p>
                                    <p><b>Cancel Reason: </b> {{$ordersQ->order_cancel_reason}}</p>
                                @endif
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#exampleModal">Change Status</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('cms.admin_order_change')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="invID" value="{{$ordersQ->id}}">
                <label for="">Order Status</label>
                <select class="form-control" id="" name="order_status" required>
                    <option @if($ordersQ->order_status == 'pending') selected @endif value="pending">pending</option>
                    <option @if($ordersQ->order_status == 'processing') selected @endif value="processing">processing</option>
                    <option @if($ordersQ->order_status == 'dispatched') selected @endif value="dispatched">dispatched</option>
                    <option @if($ordersQ->order_status == 'delivered') selected @endif value="pendeliveredding">delivered</option>
                    <option @if($ordersQ->order_status == 'canceled') selected @endif value="canceled">canceled</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
