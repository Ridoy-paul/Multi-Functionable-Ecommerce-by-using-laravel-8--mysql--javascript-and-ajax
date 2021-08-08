<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
@php

function singleVAri($variID, $pid, $colorSTS){
$variations = DB::table('product_variations')->where('variation_id', $variID)->where('product_unique_id', $pid)->get();
//echo $colorSTS;
if($colorSTS == "color" || $colorSTS == "colour"){
@endphp

<div id="drink-holder">
    <select size="2">
        @php
        foreach($variations as $single_vari){
        @endphp
        <option onclick="selectColor('{{$single_vari->attribute_name}}', '{{$single_vari->id}}')" style="height: 10px; width: 10px; padding: 10px; border-radius: 3px; margin-left: 4px; background-color: {{ $single_vari->attribute_name }}">
            </option>
        @php
        }
        @endphp
    </select>
</div>


@php
}
else {
$colorSTSCap = str_replace(' ', '_', $colorSTS);
@endphp
<div id="drink-holder">
    <select size="2" name="{{$colorSTSCap}}" id="sv_{{$colorSTSCap}}">
        @php
        foreach($variations as $single_vari){
        @endphp
        <option onclick="selectSV('sv_{{$colorSTSCap}}', '{{$single_vari->id}}')"
            value="{{ $single_vari->attribute_name }}"
            style="padding: 5px; border: 1px solid #9E9E9E; border-radius: 3px; margin-left: 4px;">
            {{ $single_vari->attribute_name }}</option>
        @php
        }
        @endphp
    </select>
</div>
@php
}
}

@endphp
<div class="row">
    <div class="col-lg-6 col-xs-12">
        <div class="quick-view-img">
            <img style="border-radius: 10px;" src="{{ asset($product->small_image) }}" alt="" class="img-fluid bg-img">
        </div>
    </div>



    <!-- hello Start --------------------------------------------------------------------------------->
    <div class="col-lg-6 rtl-text">
        <div class="product-right ">
            <div class="pro-group">
                <h2>{{ $product->title }}</h2>
                <p>Product Code: {{ $product->sku }}</p>
                <div class="pro-group">
                    <p>{{ $product->short_description }}</p>
                </div>
                <ul class="pro-price">
                    <li>৳ <div id="pPrice{{$product->id}}">{{$product->price}}</div>
                    </li>
                    @if(!empty($product->previous_price))
                    <li><span>৳ {{ $product->previous_price}}</span></li>
                    @endif
                </ul>
                <div class="revieu-box">

                </div>
            </div>
            <input type="hidden" name="" id="checkV_{{$product->id}}" value="{{$product->product_type}}">

            <div id="selectSize" class="pro-group addeffect-section product-description border-product">
                <input type="hidden" name="" id="colorVID" value="">

                <div id="inside_variation_id">
                    @if($product->product_type == 'variation')
                    @foreach($exist_variations as $variation_data)
                    @php
                    //$variName = strtolower($variation_data->vari_name);
                    $colorSts = strtolower($variation_data->vari_name);
                    $strRiplName = str_replace(' ', '_', $colorSts);

                    @endphp
                    <h6 class="product-title size-text text-dark">Select {{ $variation_data->vari_name }}</h6>
                    <input type="hidden" name="" id="sv_{{$strRiplName}}_i">
                    <ul>
                        @php $datas = singleVAri($variation_data->variation_id, $product->id, $colorSts); @endphp
                    </ul>
                    @endforeach

                    @endif
                </div>
                <h6 class="product-title">quantity</h6>
                <div class="row">
                    <div class="col-md-7">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <button type="button" onclick="Q_minus('{{$product->id}}')"
                                    class="btn btn-outline-danger btn-number" data-type="minus" data-field="quant[1]">
                                    <span class="fa fa-minus"></span>
                                </button>
                            </span>
                            <input type="number" step=any id="pQuantity{{$product->id}}"
                                class="form-control input-number" value="1" min="1">
                            <span class="input-group-append">
                                <button type="button" onclick="Q_plus('{{$product->id}}')"
                                    class="btn btn-outline-success btn-number" data-type="plus" data-field="quant[1]">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <br>

                <div class="product-buttons">
                    @if($product->stock > 0)
                    <a href="javascript:void(0)" onclick="add_to_cart('{{$product->id}}')" id="cartEffect"
                        class="btn cart-btn btn-normal tooltip-top" data-tippy-content="Add to cart">
                        <i class="fa fa-shopping-cart"></i>
                        add to cart
                    </a>
                    <a href="javascript:void(0)" onclick="Buy_NOW('{{$product->id}}')" id="cartEffect" class="btn cart-btn btn-normal tooltip-top"
                        data-tippy-content="Add to cart">Buy Now
                    </a>
                    @else
                    <div>
                        <h3 class="text-danger">Stock Out</h3>
                    </div>
                    @endif


                </div>
                <br>
            </div>
        </div>
    </div>


















































</div>
