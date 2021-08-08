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
                @if(!empty($wishlist_data))
                <div class="shopping-cart">
                    <div class="shopping-cart-table">
                        <div class="table-responsive">
                            <div class="col-md-12 text-right mb-3">
                                <!-- <a href="javascript:void(0)" class="clear_cart font-weight-bold">Clear Cart</a> -->
                            </div>
                            <table class="table table-bordered my-auto  text-center">
                                <thead>
                                    <tr>
                                        <th width="60%" class="cart-product-name">Product Name</th>
                                        <th class="cart-price">Unit Price</th>
                                        <th class="cart-romove">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="my-auto">
                                    @foreach ($wishlist_data as $data)
                                    <tr class="cartpage" id="WishlistTr{{$data['item_id']}}">

                                        <td class="cart-product-name-info" style="text-align: left;">
                                            <h4 class='cart-product-description'>
                                                <a href="javascript:void(0)">{{ $data['item_name'] }}</a><br>
                                            </h4>
                                        </td>
                                        <td class="cart-product-sub-total">
                                            <span
                                                class="cart-sub-total-price">{{ number_format($data['item_price'], 2) }}</span>
                                        </td>
                                        <td style="font-size: 20px;">
                                        <button class="btn btn-primary btn-sm tooltip-top" onclick="getproductmodal({{$data['item_id']}})" data-tippy-content="Add to cart">Add to cart</button>
                                            <button type="button" onclick="Delete_Wishlist_item({{$data['item_id']}})"
                                                class="btn btn-outline-danger btn-sm">
                                                <li class="fa fa-trash-o"></li>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- /table -->
                        </div>
                    </div><!-- /.shopping-cart-table -->
                </div><!-- /.shopping-cart -->
                @else
                <div class="row">
                    <div class="col-md-12 mycard py-5 text-center">
                        <div class="mycards">
                        <h3><b>Wishlist is empty!</b></h3><br>
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
