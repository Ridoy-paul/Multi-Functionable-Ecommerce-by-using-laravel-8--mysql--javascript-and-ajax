@php
    $shop_s = DB::table('shop_settings')->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
   <title>{{ $shop_s->shop_name }}</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <meta name="description" content="{{ $shop_s->shop_name }}">
   <meta name="keywords" content="{{ $shop_s->shop_name }}">
   <meta name="author" content="{{ $shop_s->shop_name }}">
   <link rel="icon" href="{{ asset($shop_s->logo) }}" type="image/x-icon">
   <link rel="shortcut icon" href="{{ asset($shop_s->logo) }}" type="image/x-icon">
   <!--Google font-->
   <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Raleway&amp;display=swap" rel="stylesheet">
   <!--icon css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/themify.css') }}">
   <!--Slick slider css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/slick.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/slick-theme.css') }}">
   <!--Animate css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/animate.css') }}">
   <!-- Bootstrap css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap.css') }}">
   <!-- Theme css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/color1.css') }}" media="screen" id="color">
   <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> -->
   <link rel="stylesheet" type="text/css" href="{{ asset('css/toastify.min.css') }}">
   
   
   <script src="{{ asset('js/fontawesome.js') }}" crossorigin="anonymous"></script>
   <!-- <script src="https://kit.fontawesome.com/1ad7b79211.js" crossorigin="anonymous"></script> -->
   

   <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> -->
   <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
   
   
   


<style>
   

   @media only screen and (min-width: 825px) {
      .layout-header1{
         padding-top: 0px;
         padding-bottom: 0px;
      }
      div#navbarToggleExternalContent {
         height: 368px;
         overflow: auto;
      }

      #indProduct:hover{
         -webkit-box-shadow:0 0 10px rgba(0,0,0,0.8);
         -moz-box-shadow:0 0 10px rgba(0,0,0,0.8);
         box-shadow:0 0 10px rgba(0,0,0,0.8);
      }

      #profilePaul {
         border: 1px solid green; 
         color: #fff; 
         padding: 5px; 
         border-radius: 5px;
      }

      .cartQtyInputBox {
         margin: 0px 10px;
      }

      .cartPlus_minus {
         font-size: 15px;
         padding: 10px;
         border: 1px solid #00BFA6;
         border-radius: 5px;
         cursor: pointer;
      }


      /* test header css */
      /* .custom-container {
         height: 50px;
      } */

      .navbar-menu {
         height: 50px;
      }

      .category-header .navbar-menu .category-left .nav-block .nav-left .navbar {
         padding: 16px 0;
      }

      .category-right {
         height: 50px;
      }

      .input-group {
         height: 40px !important;
      }

      #menu-left-paul {
         height: 75px;
         margin-left: -80px;
      }
      #shop-logo-paul {
         height: 65px;
      }

      #menu-block-paul {
         margin-left: -285px;
      }
      /* test header css */

      .section-big-pt-space {
         padding-top: 15px;
      }

   }

   @media only screen and (max-width : 1024px) {
    input[type=number]::-webkit-inner-spin-button, 

    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none;
    }

    .theme-slider .slider-banner.slide-banner-3 .slider-img {
      height: 122px;
    }

    #invoicePageLogo {
         width: 140%;
   }
   .font_size_small{
      font-size: 10px;
   }
   
   .cartQtyInputBox {
      margin: 0px 5px;
      width: 40px;
   }
   .cartPlus_minus {
      font-size: 10px;
      padding: 5px;
      border: 1px solid #00BFA6;
      border-radius: 5px;
      cursor: pointer;
   }
   #drink-holder select {
      margin:-5px -0px -5px -5px !important;
   }
}

/* category to subcat dropdown css Start */
.indSubcat {
   /* padding-left: 10px !important; */
   padding-left: 50px;
}

/* category to subcat dropdown css End */


.add_to_cart.left .cart-inner .cart_media ul.cart_product, .add_to_cart.right .cart-inner .cart_media ul.cart_product {
    height: calc(100vh - 263px);
    overflow-y: auto;
}

   #dynamicVariation ul li a {
    color: #070a09;
    font-size: calc(14px + (16 - 14) * ((100vw - 320px) / (1920 - 320)));
    text-transform: uppercase;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    height: 100%;
}

*:focus {
    outline: none;
}

#drink-holder select {
  appearance: none;
  -webkit-appearance: none;
  background-color: transparent;
  border: 0;
  padding:10px;
  margin:-5px -20px -5px -5px;
}

#drink-holder select option {
  display:inline-block;
}

#drink-holder {
  display:inline-block;
  vertical-align:top;
  overflow:hidden;
}

.theme-pannel-main {
   display: none;
}
.color-picker {
   display: none;
}

.menuMobile {
   width: 16px !important; 
   color: #fff
}

/* .inputTypeNumberQ::-webkit-inner-spin-button {
    opacity: 1
} */

.select2-results__option {
   display: block;
}

.cartPlus_minusSide {
      font-size: 10px;
      padding: 5px;
      border: 1px solid #00BFA6;
      border-radius: 5px;
      cursor: pointer;
}
.cartQtyInputBoxSide {
   margin: 0px 5px;
   width: 50px;
}





</style>

</head>
<body class="bg-light">

<!-- loader start -->
<div class="loader-wrapper">
         <div>
            <img src="{{ asset('frontend/assets/images/Spinner.gif') }}" alt="loader">
         </div>
      </div>
<!-- loader end -->

<!--header start-->
@include('user.pages.body.header')
<!--header end-->

<!--Body end-->
@yield('user_content')
<!--Body end-->


<!-- footer start -->
@include('user.pages.body.footer')
<!-- footer End -->