<footer>
    <div class="footer1 ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-main">
                        <div class="footer-box">
                            <div class="footer-title mobile-title">
                                <h5>about</h5>
                            </div>
                            <div class="footer-contant">
                                <div class="footer-logo">
                                    <a href="index.html">
                                        <img src="{{ asset($shop_s->logo) }}" class="img-fluid" alt="logo">
                                    </a>
                                </div>
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a
                                    piece.</p>
                                <ul class="sosiyal">
                                    <li><a href="{{ $shop_s->facebook }}"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{ $shop_s->youtube }}"><i class="fa fa-youtube-play"></i></a></li>
                                    <li><a href="{{ $shop_s->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{ $shop_s->instagram }}"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>Others</h5>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li><a href="{{route('user.about.us')}}">about us</a></li>
                                    <li><a href="{{route('user.contact.us')}}">contact us</a></li>
                                    <li><a href="{{route('user.mission.vission')}}">Mission & Vission</a></li>
                                    <li><a href="{{route('user.privacy.policy')}}">Privacy & Policy</a></li>
                                    <li><a href="{{route('user.terms.and.conditions')}}">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>quick link</h5>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li><a href="{{ route('/') }}">Home</a></li>
                                    <li><a href="{{url('/shop')}}">Shop</a></li>
                                    <li><a href="{{ route('product_cart') }}">Cart</a></li>
                                    <li><a href="{{route('user.wishlist')}}">Wishlist</a></li>
                                    <li><a href="{{route('user.trackorder')}}">Track My Order</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>contact us</h5>
                            </div>
                            <div class="footer-contant">
                                <ul class="contact-list">
                                    <li><i class="fa fa-map-marker"></i>{{ $shop_s->address }}</li>
                                    <li><i class="fa fa-phone"></i>call us:
                                        <span>{{ $shop_s->phone_1.", ".$shop_s->phone_2 }}</span></li>
                                    <li><i class="fa fa-envelope-o"></i>email us: {{ $shop_s->email }}</li>
                                    <li><i class="fa fa-fax"></i>fax <span>123456</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter footer-border">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8 col-sm-12">
                    <div class="footer-left">
                        <p>Design & Developed By <a href="http://faraitfusion.com">FARA IT Fusion</a></p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-4 col-sm-12">
                    <div class="footer-right">
                        <ul class="payment">
                            <li><a href="javascript:void(0)"><img
                                        src="{{ asset('frontend/assets/images/layout-1/pay/1.png') }}" class="img-fluid"
                                        alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img
                                        src="{{ asset('frontend/assets/images/layout-1/pay/2.png') }}" class="img-fluid"
                                        alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img
                                        src="{{ asset('frontend/assets/images/layout-1/pay/3.png') }}" class="img-fluid"
                                        alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img
                                        src="{{ asset('frontend/assets/images/layout-1/pay/4.png') }}" class="img-fluid"
                                        alt="pay"></a></li>
                            <li><a href="javascript:void(0)"><img
                                        src="{{ asset('frontend/assets/images/layout-1/pay/5.png') }}" class="img-fluid"
                                        alt="pay"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
@php
$userID = Cookie::get('user_id');
$userName = Cookie::get('user_name');
$userQ = DB::table('users')->where('id', $userID)->first();

@endphp

<!-- My account bar start-->
<div id="myAccount" class="add_to_cart right account-bar">
    <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my account</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeAccount()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @if(!empty($userID))
        <div class="row">
            <div class="col-md-12 card">
                <div class="card-header text-center">
                    <i style="font-size: 50px;" class="fas fa-user-circle"></i>
                    <h4 class="card-title"><b>{{$userName}}</b></h4>
                    <div class="row">
                            <div class="col-md-6 col-6">
                            <p style="border-top: 2px; border-bottom: 2px; border-radius: 15px; font-size: 15px; background-color: #544AF4;" class="card-text pl-5 pr-5 text-light">P {{number_format($userQ->point, 2)}}</p>
                            </div>
                            <div class="col-md-6 col-6">
                            <p style="border-top: 2px; border-bottom: 2px; border-radius: 15px; font-size: 15px; background-color: #544AF4;" class="card-text pl-5 pr-5 text-light">৳ {{number_format($userQ->balance, 2)}}</p>
                            </div>
                        </div>
                        <br>
                        <a href="{{url('/convertPtoTK')}}" class="btn btn-success btn-sm" style="border-radius: 30px;"><i class="fas fa-sync-alt"></i> Convert</a>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{route('user.myaccount')}}" class="btn btn-normal" type="button">My Account</a>
                        <a class="btn btn-normal" href="{{route('user.all.orders')}}">Orders</a>
                        <a href="{{route('user.trackorder')}}" class="btn btn-normal" type="button">Order Tracking</a>
                        <a href="{{route('user.logout')}}" class="btn btn-normal" type="button">Logout</a>
                    </div>
                </div>

            </div>
        </div>
        @else
        <form class="theme-form" action="{{route('user.login')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email or Phone</label>
                <input type="text" class="form-control" name="email_or_phone" id="email" placeholder="" required="">
            </div>
            <div class="form-group">
                <label for="review">Password</label>
                <input type="password" class="form-control" name="password" id="review"
                    placeholder="Enter your password" required="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-solid btn-md btn-block ">Login</button>
            </div>
            <div class="accout-fwd">
                <a href="{{route('user_update_pass_s_one')}}" class="d-block">
                    <h5>forget password?</h5>
                </a>
                <a href="{{route('user.register.page')}}" class="d-block">
                    <h6>you have no account ?<span>signup now</span></h6>
                </a>
            </div>
        </form>
        @endif

    </div>
</div>
<!-- Add to account bar end-->



<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="product_details_modal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body" id="modal_body">

            </div>
        </div>
    </div>
</div>
<!-- Quick-view modal popup end-->


<!-- Add to cart bar -->
<div id="cart_side" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my cart</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeCart()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="cart_media" id="cart_father">
            
        </div>
    </div>
</div>
<!-- Add to cart bar end-->


<!-- latest jquery-->
<script src="{{ asset('frontend/assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- slick js-->
<script src="{{ asset('frontend/assets/js/slick.js') }}"></script>

<!-- tool tip js -->
<script src="{{ asset('frontend/assets/js/tippy-popper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/tippy-bundle.iife.min.js') }}"></script>
<!-- popper js-->
<script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
<!-- menu js-->
<script src="{{ asset('frontend/assets/js/menu.js') }}"></script>

<!-- Bootstrap js-->

<!-- father icon -->
<script src="{{ asset('frontend/assets/js/feather.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/feather-icon.js') }}"></script>

<!-- Bootstrap js-->
<script src="{{ asset('frontend/assets/js/bootstrap.js') }}"></script>

<!-- Theme js-->

<script src="{{ asset('frontend/assets/js/modal.js') }}"></script>
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/shop.js') }}"></script>

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> -->
<script src="{{ asset('js/toastify-js.js') }}"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script> -->
<script src="{{ asset('js/jquery.lazyload.js') }}"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->
<script src="{{ asset('js/select2.min.js') }}"></script>
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

@if(session('otpNOTmatched'))
<script>
    swal({
        title: "OTP Not Matched",
        text: "Please Try Again With Correct OTP",
        icon: "warning",
        button: "Ok",
    });

</script>
@endif

@if(session('notAllow'))
<script>
    swal({
        title: "{{ session('notAllow') }}",
        text: "",
        icon: "warning",
        button: "Ok",
    });

</script>
@endif

@if(session('userSuccess'))
<script>
    swal({
        title: "{{ session('userSuccess') }}",
        text: "",
        icon: "success",
        button: "Ok",
    });

</script>
@endif





<script>
    $(document).ready(function () {
        //alert("hello paul");
        $("img").lazyload({
            effect: "fadeIn"
        });

        var homepage = $('#homePage').val();
        if (homepage != 1) {
            var element = document.getElementById("navbarToggleExternalContent");
            element.classList.remove("show");
        }

        $('.js-example-basic-single').select2();


    });

    function getproductmodal(id) {

        $("#modal_body").html('<p><img src="{{ asset('frontend/assets/images/Spinner.gif ')}}" style="width: 200px;">Loading....</p>');
        $("#product_details_modal").modal("show");
        $.ajax({
            url: '/getProducModal',
            method: "GET",
            data: {
                proid: id
            },
            success: function (response) {
                $("#modal_body").html(response);

            }
        });

    }

    function removemodal() {
        $("#subscribe").toggleClass("active");
    }

    function leftCartSidebar() {

        $("#cart_father").html('<div style="text-align: center;"><img src="{{ asset('frontend/assets/images/loader.gif')}}"></div>');
        $.ajax({
            url: '/get_leftCartSidebar',
            method: "GET",
            data: {
                proid: 1
            },
            success: function (response) {
                //alert("hello paul");
                //console.log(response);
                $("#cart_father").html(response);

            }
        });


    }

</script>
</body>

</html>
