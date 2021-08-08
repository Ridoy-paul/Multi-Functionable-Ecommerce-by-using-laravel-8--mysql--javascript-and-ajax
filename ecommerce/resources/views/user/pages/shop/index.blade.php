@extends('user.user_master')
@section('user_content')

@php $lastID = 0; @endphp

<!-- section start -->
<section class="section-big-pt-space ratio_asos b-g-light">
    <div class="collection-wrapper">
        <div class="custom-container">
            <div class="row">
                <div class="col-sm-3 collection-filter category-page-side">
                    <!-- side-bar colleps block stat -->
                    <div class="collection-filter-block creative-card creative-inner category-side">
                        <!-- brand filter start -->
                        <div class="collection-mobile-back">
                            <span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span>
                        </div>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title mt-0">brand</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach($brands as $brand)
                                    <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                        <input type="radio" name="brand" value="{{$brand->id}}"
                                            class="custom-control-input form-check-input" id="brand{{$brand->id}}">
                                        <label class="custom-control-label form-check-label"
                                            for="brand{{$brand->id}}">{{$brand->brand_name}}</label>
                                    </div>
                                    @endforeach
                                    <div class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                        <input type="radio" checked name="brand" value="0"
                                            class="custom-control-input form-check-input" id="bnone">
                                        <label class="custom-control-label form-check-label" style="color: #FF6000;"
                                            for="bnone">None</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title mt-0">Categories</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    <br>
                                    <ul>
                                        @foreach($catgories as $category)
                                        @php $subcatCount = DB::table('sub_categories')->where('catID',
                                        $category->id)->count(); @endphp
                                        @if($subcatCount != 0)
                                        <li>
                                            &nbsp;<a href="javascript:void(0)"
                                                style="font-size: 15px; font-weight:bold; color: #777777;"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#CATID{{$category->id}}">{{ $category->name }} &nbsp;<i
                                                    class="fa fa-angle-right"></i></a>
                                            <ul style="padding-left: 30px; padding-bottom: 5px;"
                                                class="collapse nav-desk" id="CATID{{$category->id}}">
                                                @php $subcats = DB::table('sub_categories')->where('catID',
                                                $category->id)->get(); @endphp
                                                @foreach($subcats as $subcat)
                                                <div
                                                    class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                                    <input type="radio" name="catAndSubcat"
                                                        value="s,{{ $subcat->id }}"
                                                        class="custom-control-input form-check-input"
                                                        id="subcat{{ $subcat->id }}">
                                                    <label class="custom-control-label form-check-label"
                                                        for="subcat{{ $subcat->id }}">{{ $subcat->sub_cat_name }}</label>
                                                </div>
                                                @endforeach
                                            </ul>
                                        </li><br>
                                        @else
                                        <div
                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                            <input type="radio" name="catAndSubcat" value="c,{{ $category->id }}"
                                                class="custom-control-input form-check-input"
                                                id="cat{{ $category->id }}">
                                            <label class="custom-control-label form-check-label"
                                                for="cat{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                        @endif
                                        @endforeach
                                        <div
                                            class="custom-control custom-checkbox  form-check collection-filter-checkbox">
                                            <input type="radio" checked name="catAndSubcat" value="0,0"
                                                class="custom-control-input form-check-input" id="none">
                                            <label class="custom-control-label form-check-label" style="color: #FF6000;"
                                                for="none">None</label>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- silde-bar colleps block end here -->

                </div>
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="collection-product-wrapper">
                                    <div class="product-top-filter">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="filter-main-btn"><span class="filter-btn  "><i
                                                            class="fa fa-filter" aria-hidden="true"></i> Filter</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-wrapper-grid product">
                                        <div class="row" id="product_BODY">
                                            @foreach($products as $product)
                                            <div class="col-xl-3 col-md-4 col-6  col-grid-box">
                                            <div class="product-box product-box2 p-2">
                                                <div id="indProduct">
                                                <div class="product-imgbox" >
                                                    <div class="product-front">
                                                        <a href="{{ url('/product-details/'.$product->id.'/'.$product->url) }}">
                                                            <img src="{{ asset($product->small_image) }}" class="img-fluid lazyload"
                                                                alt="{{ $product->meta_title }}">
                                                        </a>
                                                    </div>
                                                    <div class="product-icon icon-inline">
                                                        @if($product->stock > 0)
                                                            @if($product->product_type == 'simple')
                                                            <input type="hidden" name="" value="1" id="checkV_{{$product->id}}">
                                                            <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('{{$product->id}}', 1)" data-tippy-content="Add to cart">
                                                                <i data-feather="shopping-cart"></i>
                                                            </button>
                                                            @else
                                                            <button class="tooltip-top  add-cartnoty" onclick="getproductmodal('{{ $product->id }}')" data-tippy-content="Add to cart">
                                                                <i data-feather="shopping-cart"></i>
                                                            </button>
                                                            @endif
                                                        @endif
                                                        <a href="javascript:void(0)" onclick="getproductmodal('{{ $product->id }}')"
                                                            class="tooltip-top" data-tippy-content="Quick View">
                                                            <i data-feather="eye"></i>
                                                        </a>
                                                        <button class="tooltip-top add-cartnoty" onclick="Add_to_wishlist('{{$product->id}}')" data-tippy-content="Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>

                                                    </div>
                                                    <div class="new-label1">
                                                        <div>new</div>
                                                    </div>
                                                    @if($product->stock > 0)
                                                    <div class="on-sale1 bg-success text-light">
                                                        on sale
                                                    </div>
                                                    @else
                                                    <div class="on-sale1 bg-danger text-light">
                                                        Stock Out
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="product-detail product-detail2">
                                                    <a href="{{ url('/product-details/'.$product->id.'/'.$product->url) }}">
                                                        <h3>{{ $product->title }}</h3>
                                                    </a>
                                                    <h5>
                                                    <p class="d-none" id="pPrice{{$product->id}}">{{$product->price}}</p>
                                                    ৳ {{ $product->price}}
                                                        <span>
                                                        @if(!empty($product->previous_price))
                                                        ৳ {{ $product->previous_price}}
                                                        @endif
                                                        </span>
                                                    </h5>
                                                    <div class="row">
                                                        
                                                    </div>
                                                    </div>
                                                    </div>
                                                
                                            </div>
                                                @php $lastID = $product->id; @endphp
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$productFrom}}" name="" id="selectedCatAndSubcat">
                                    <input type="hidden" name="" value="0" id="selectedBrand">
                                    <input type="hidden" name="" value="{{$productFrom}}" id="productFrom">
                                    <input type="hidden" id="productLastID" name="" value="{{$lastID}}" id="">
                                    <div class="">
                                        <div class="">
                                            <div class="row" id="addProductBUTTON">
                                                <div class="col-xl-12 col-md-12 col-sm-12 text-center">
                                                <hr>
                                                    <button onclick="loadMore()" class="btn cart-btn btn-normal">Load More</button>
                                                @if($lastID < 5)
                                                
                                                @else
                                                
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section End -->

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            </div>
        </div>
    </div>
</section>

@endsection
