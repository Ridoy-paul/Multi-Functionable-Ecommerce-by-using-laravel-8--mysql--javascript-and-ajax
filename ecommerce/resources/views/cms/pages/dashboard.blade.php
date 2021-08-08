@extends('cms.cms_master')
@section('admin_content')
@php

$total_order = DB::table('orders')->count();
$pen_ord = DB::table('orders')->where('order_status', 'pending')->count();
$processing_ord = DB::table('orders')->where('order_status', 'processing')->count();
$dispatched_ord = DB::table('orders')->where('order_status', 'dispatched')->count();
$delivered_ord = DB::table('orders')->where('order_status', 'delivered')->count();
$calceled_ord = DB::table('orders')->where('order_status', 'canceled')->count();
$total_porducts = DB::table('products')->count();
$totalCat = DB::table('categories')->count();
$total_sub_cat = DB::table('sub_categories')->count();
$totalBrands = DB::table('brands')->count();
$total_custoers = DB::table('users')->count();

@endphp
<section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
          <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Total Orders</h6>
                      <span class="h4 text-warning font-weight-bold mb-0">{{$total_order}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-orange text-white">
                        <i class="fas fa-dollar-sign"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('cms_all_order') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Pending Orders</h6>
                      <span class="h4 text-warning font-weight-bold mb-0">{{$pen_ord}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-orange text-white">
                        <i class="fas fa-book-open"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('cms_pending_order') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Processing Orders</h6>
                      <span class="h4 text-warning font-weight-bold mb-0">{{$processing_ord}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-orange text-white">
                        <i class="fas fa-book-open"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('cms_processing_order') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Dispatched Orders</h6>
                      <span class="h4 text-warning font-weight-bold mb-0">{{$dispatched_ord}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-orange text-white">
                        <i class="fas fa-book-open"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('cms_dispatched_order') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Delivered Orders</h6>
                      <span class="h4 text-warning font-weight-bold mb-0">{{$delivered_ord}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-orange text-white">
                        <i class="fas fa-book-open"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('cms_delivered_order') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Canceled Orders</h6>
                      <span class="h4 text-warning font-weight-bold mb-0">{{$calceled_ord}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-orange text-white">
                        <i class="fas fa-book-open"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('cms_canceled_order') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Categories</h6>
                      <span class="h4 text-info font-weight-bold mb-0">{{$totalCat}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-green text-white">
                        <i class="fas fa-briefcase"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('all_cat') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Sub Categories</h6>
                      <span class="h4 text-info font-weight-bold mb-0">{{$total_sub_cat}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-green text-white">
                        <i class="fas fa-book-open"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('all_sub_cat') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Brands</h6>
                      <span class="h4 text-info font-weight-bold mb-0">{{$totalBrands}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-cyan text-white">
                        <i class="fas fa-piggy-bank"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('all_brand') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Products</h6>
                      <span class="h4 text-info font-weight-bold mb-0">{{$total_porducts}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-cyan text-white">
                        <i class="fas fa-piggy-bank"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('all_active_product') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card">
                <div class="card-body card-type-3">
                  <div class="row">
                    <div class="col">
                      <h6 class="text-muted mb-0">Customers</h6>
                      <span class="h4 font-weight-bold mb-0">{{$total_custoers}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="card-circle l-bg-purple text-white">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <a href="{{ route('cms.all_customers') }}" class="text-info mr-2"><i class="fa fa-arrow-up"></i> See info</a>
                  </p>
                </div>
              </div>
            </div>

          </div>
         
        </section>
        
@endsection