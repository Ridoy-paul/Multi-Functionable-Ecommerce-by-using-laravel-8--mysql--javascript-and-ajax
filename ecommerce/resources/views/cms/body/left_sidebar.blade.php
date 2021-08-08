<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">
              @if(!empty($shop_s->shop_name))
                <span class="logo-name" style="font-size: 15px; text-shadow: 2px 2px 4px #F50057; font-weight: bold;">{{ $shop_s->shop_name }}</span>
              @else
                <span class="logo-name text-danger">SetUp Setting</span>
              @endif
              
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="" class="has-dropdown"><i class="fas fa-home"></i><span>Dashboard & Setting</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ url('/cms') }}">Dashboard</a></li>
                <li><a class="nav-link" href="{{ route('admin_setting') }}">Setting</a></li>
                <li><a class="nav-link" href="{{ route('all_slider') }}">Slider</a></li>
                <li><a class="nav-link" href="{{ route('all_promotion_banner') }}">Ads Banner</a></li>
                <!-- <li><a class="nav-link" href="{{ route('popup_modal') }}">popup Modal</a></li> -->
              </ul>
            </li>
            <li class="menu-header"></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-sort-amount-up"></i><span>Orders</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('cms_all_order') }}">All Orders</a></li>
              <li><a class="nav-link" href="{{ route('cms_pending_order') }}">Pending Orders</a></li>
              <li><a class="nav-link" href="{{ route('cms_processing_order') }}">Processing Orders</a></li>
              <li><a class="nav-link" href="{{ route('cms_dispatched_order') }}">Dispatched Orders</a></li>
              <li><a class="nav-link" href="{{ route('cms_delivered_order') }}">Delivered Orders</a></li>
              <li><a class="nav-link" href="{{ route('cms_canceled_order') }}">Canceled Orders</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="{{ route('all_brand') }}"><i class="fas fa-bold"></i><span>Brand</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-briefcase"></i><span>Category & SubCat</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('all_cat') }}">Categories</a></li>
                <li><a class="nav-link" href="{{ route('all_sub_cat') }}">Sub-Categories</a></li>
                  
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-piggy-bank"></i><span>Products</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('add_product') }}">Add Products</a></li>
              <li><a class="nav-link" href="{{ route('all_active_product') }}">Active Products</a></li>
              <li><a class="nav-link" href="{{ route('specialDiscountProduct') }}">Special Discount Product</a></li>
              <li><a class="nav-link" href="{{ route('all_deactive_product') }}">Deactive Products</a></li>
              <li><a class="nav-link text-info" href="{{ route('product_file_manager') }}">File Manager</a></li>
              <li><a class="nav-link text-info" href="{{ route('product_csv_page') }}">Upload Products By CSV</a></li>
              
              
              </ul>
            </li>
            <li><a class="nav-link" href="{{ route('all_varieation') }}"><i class="fas fa-arrows-alt"></i><span>Varieation</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-shipping-fast"></i><span>Shipping Charge & Area</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('all_shipping_crg') }}">Shipping Charge</a></li>
              <li><a class="nav-link" href="{{ route('shipping_sub_area') }}">Shipping Area (<div class="text-warning">Thana</div>)</a></li>              
              </ul>
            </li>
            <li><a class="nav-link" href="{{ route('all_promo_code') }}"><i class="fas fa-atom"></i><span>Promo / Coupon Code</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-bullhorn"></i><span>Campaign</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('all_wallet') }}">Wallet</a></li>
              <li><a class="nav-link" href="{{ route('shipping_sub_area') }}">Upcoming</a></li>              
              </ul>
            </li>
            <li><a class="nav-link" href="{{ route('all_payment_method') }}"><i class="fas fa-money-bill-wave"></i><span>Payment Method</span></a></li>
            <li><a class="nav-link" href="{{ route('cms.all_customers') }}"><i class="fas fa-user"></i><span>Customers</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-clipboard"></i><span>Blog</span></a>
              <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('cms.add_blog_page') }}">Add Blog</a></li>
              <li><a class="nav-link" href="{{ route('all_blog') }}">All Blog</a></li>              
              </ul>
            </li>
          </ul>
        </aside>
      </div>











    