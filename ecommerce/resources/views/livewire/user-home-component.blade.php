<div>
<!--slider start-->
@include('user.pages.body.slider')
<!--slider end-->

<!--title start-->
<div class="title8 section-big-pt-space">
    <h4>New Arrival</h4>
</div>
<!--title end-->

<!-- product tab start -->
<section class="section-big-mb-space ratio_square product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pr-0">
                <div class="product-slide-5 product-m no-arrow">
                    @foreach($new_arrivals as $new_arrival)
                    <div>
                        <div class="product-box product-box2 p-2">
                           <div id="indProduct">
                            <div class="product-imgbox" >
                                <div class="product-front">
                                    <a href="{{ url('/product-details/'.$new_arrival->id.'/'.$new_arrival->url) }}">
                                        <img src="{{ asset($new_arrival->small_image) }}" class="img-fluid lazyload"
                                            alt="{{ $new_arrival->meta_title }}">
                                    </a>
                                </div>
                                <div class="product-icon icon-inline">
                                    @if($new_arrival->stock > 0)
                                       @if($new_arrival->product_type == 'simple')
                                        <input type="hidden" name="" value="1" id="checkV_{{$new_arrival->id}}">
                                       <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('{{$new_arrival->id}}', 1)" data-tippy-content="Add to cart">
                                          <i data-feather="shopping-cart"></i>
                                       </button>
                                       @else
                                       <button class="tooltip-top  add-cartnoty" onclick="getproductmodal('{{ $new_arrival->id }}')" data-tippy-content="Add to cart">
                                          <i data-feather="shopping-cart"></i>
                                       </button>
                                       @endif
                                    @endif
                                    <a href="javascript:void(0)" onclick="getproductmodal('{{ $new_arrival->id }}')"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>

                                </div>
                                <div class="new-label1">
                                    <div>new</div>
                                </div>
                                @if($new_arrival->stock > 0)
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
                                <a href="{{ url('/product-details/'.$new_arrival->id.'/'.$new_arrival->url) }}">
                                    <h3>{{ $new_arrival->title }}</h3>
                                </a>
                                <h5>
                                <p class="d-none" id="pPrice{{$new_arrival->id}}">{{$new_arrival->price}}</p>
                                ৳ {{ $new_arrival->price}}
                                    <span>
                                    @if(!empty($new_arrival->previous_price))
                                    ৳ {{ $new_arrival->previous_price}}
                                    @endif
                                    </span>
                                </h5>
                                <div class="row">
                                   
                                </div>
                                </div>
                                </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->

<input type="hidden" name="" value="1" id="homePage">

<!--title start-->
<div class="title8 section-big-pt-space">
    <h4>Special Offer</h4>
</div>
<!--title end-->

<!-- product tab start -->
<section class="section-big-mb-space ratio_square product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pr-0">
                <div class="product-slide-5 product-m no-arrow">
                @foreach($special_offers as $special_offer)
                    <div>
                        <div class="product-box product-box2 p-2">
                           <div id="indProduct">
                            <div class="product-imgbox" >
                                <div class="product-front">
                                    <a href="{{ url('/product-details/'.$special_offer->id.'/'.$special_offer->url) }}">
                                        <img src="{{ asset($special_offer->small_image) }}" class="img-fluid lazyload"
                                            alt="product">
                                    </a>
                                </div>
                                
                                <div class="product-icon icon-inline">
                                    @if($special_offer->stock > 0)
                                       @if($special_offer->product_type == 'simple')
                                        <input type="hidden" name="" value="1" id="checkV_{{$special_offer->id}}">
                                       <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('{{$special_offer->id}}')" data-tippy-content="Add to cart">
                                          <i data-feather="shopping-cart"></i>
                                       </button>
                                       @else
                                       <button class="tooltip-top  add-cartnoty" onclick="getproductmodal('{{ $special_offer->id }}')" data-tippy-content="Add to cart">
                                          <i data-feather="shopping-cart"></i>
                                       </button>
                                       @endif
                                    @endif
                                    <a href="javascript:void(0)" onclick="getproductmodal('{{ $special_offer->id }}')"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>
                                </div>

                                <div class="new-label1">
                                    <div>Offer</div>
                                </div>
                                @if($special_offer->stock > 0)
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
                                <a href="{{ url('/product-details/'.$special_offer->id.'/'.$special_offer->url) }}">
                                    <h3>{{ $special_offer->title }}</h3>
                                </a>
                                <p class="d-none" id="pPrice{{$special_offer->id}}">{{$special_offer->price}}</p>
                                <h5>
                                ৳ {{ $special_offer->price}}
                                    <span>
                                    @if(!empty($special_offer->previous_price))
                                    ৳ {{ $special_offer->previous_price}}
                                    @endif
                                    </span>
                                </h5>
                                <div class="row">
                                   
                                </div>
                                </div>
                                </div>
                            
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->


<!--title start-->
<div class="title8 section-big-pt-space">
    <h4>Most Popular Items</h4>
</div>
<!--title end-->

<!-- product tab start -->
<section class="section-big-mb-space ratio_square product">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pr-0">
                <div class="product-slide-5 product-m no-arrow">
                    <div>
                        <div class="product-box product-box2">
                            <div class="product-imgbox">
                                <div class="product-front">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/1.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-back">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/6.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-icon icon-inline">
                                    <button class="tooltip-top  add-cartnoty" data-tippy-content="Add to cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>
                                </div>
                                <div class="new-label1">
                                    <div>new</div>
                                </div>
                                <div class="on-sale1">
                                    on sale
                                </div>
                            </div>
                            <div class="product-detail product-detail2 ">
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <a href="product-page(no-sidebar).html">
                                    <h3>women fashion shoes</h3>
                                </a>
                                <h5>
                                    $50
                                    <span>
                                        $80
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box product-box2">
                            <div class="product-imgbox">
                                <div class="product-front">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/2.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-back">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/7.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-icon icon-inline">
                                    <button class="tooltip-top  add-cartnoty" data-tippy-content="Add to cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>
                                </div>
                                <div class="new-label1">
                                    <div>new</div>
                                </div>
                                <div class="on-sale1">
                                    on sale
                                </div>
                            </div>
                            <div class="product-detail product-detail2 ">
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <a href="product-page(no-sidebar).html">
                                    <h3>men analogue watch</h3>
                                </a>
                                <h5>
                                    $10
                                    <span>
                                        $30
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box product-box2">
                            <div class="product-imgbox">
                                <div class="product-front">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/3.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-back">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/8.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-icon icon-inline">
                                    <button class="tooltip-top  add-cartnoty" data-tippy-content="Add to cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>
                                </div>
                                <div class="new-label1">
                                    <div>new</div>
                                </div>
                                <div class="on-sale1">
                                    on sale
                                </div>
                            </div>
                            <div class="product-detail product-detail2 ">
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <a href="product-page(no-sidebar).html">
                                    <h3>wireless headphones</h3>
                                </a>
                                <h5>
                                    $34
                                    <span>
                                        $40
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box product-box2">
                            <div class="product-imgbox">
                                <div class="product-front">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/4.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-back">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/9.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-icon icon-inline">
                                    <button class="tooltip-top  add-cartnoty" data-tippy-content="Add to cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>
                                </div>
                                <div class="new-label1">
                                    <div>new</div>
                                </div>
                                <div class="on-sale1">
                                    on sale
                                </div>
                            </div>
                            <div class="product-detail product-detail2 ">
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <a href="product-page(no-sidebar).html">
                                    <h3>redmi not 9 pro</h3>
                                </a>
                                <h5>
                                    $250
                                    <span>
                                        $390
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box product-box2">
                            <div class="product-imgbox">
                                <div class="product-front">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/5.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-back">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/10.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-icon icon-inline">
                                    <button class="tooltip-top  add-cartnoty" data-tippy-content="Add to cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>
                                </div>
                                <div class="new-label1">
                                    <div>new</div>
                                </div>
                                <div class="on-sale1">
                                    on sale
                                </div>
                            </div>
                            <div class="product-detail product-detail2 ">
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <a href="product-page(no-sidebar).html">
                                    <h3>Red Casual Backpack</h3>
                                </a>
                                <h5>
                                    $80
                                    <span>
                                        $130
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box product-box2">
                            <div class="product-imgbox">
                                <div class="product-front">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/3.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-back">
                                    <a href="product-page(left-sidebar).html">
                                        <img src="../assets/images/mega-store/product/8.jpg" class="img-fluid  "
                                            alt="product">
                                    </a>
                                </div>
                                <div class="product-icon icon-inline">
                                    <button class="tooltip-top  add-cartnoty" data-tippy-content="Add to cart">
                                        <i data-feather="shopping-cart"></i>
                                    </button>

                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quick-view"
                                        class="tooltip-top" data-tippy-content="Quick View">
                                        <i data-feather="eye"></i>
                                    </a>
                                    <a href="compare.html" class="tooltip-top" data-tippy-content="Compare">
                                        <i data-feather="refresh-cw"></i>
                                    </a>
                                </div>
                                <div class="new-label1">
                                    <div>new</div>
                                </div>
                                <div class="on-sale1">
                                    on sale
                                </div>
                            </div>
                            <div class="product-detail product-detail2 ">
                                <ul>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <a href="product-page(no-sidebar).html">
                                    <h3>wireless headphones</h3>
                                </a>
                                <h5>
                                    $42
                                    <span>
                                        $65
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product tab end -->



<!-- Newsletter modal popup start -->
<!-- <div class="modal fade bd-example-modal-lg theme-modal" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">--> -->
        <!-- <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> -->
          <!-- <div class="modal-content"> -->
            <!-- <div class="modal-body"> -->
               <!-- <div class="news-latter"> -->
                 <!-- <div class="modal-bg"> -->
                   <!-- <div class="newslatter-main"> -->
                     <!-- <div class="offer-content"> -->
                     <!-- <div> -->
                       <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                       <!-- <h2>{{ $shop_s->popup_modal_title }}</h2> -->
                       <!-- <p style="text-align: justify;">{{ $shop_s->popup_modal_description }}</p> -->
                     <!-- </div> -->
                   <!-- </div> -->
                   <!-- <div class="imd-wrraper"> -->
                       <!-- <img src="{{ asset($shop_s->popup_modal_image) }}" alt="newsletterimg" class="img-fluid bg-img"> -->
                   <!-- </div>
                   </div>
                 </div>
               </div>
             </div>
          </div>
        </div> -->
<!-- </div> -->
<!--Newsletter Modal popup end-->

</div>