@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1 class="text-warning">All Active Special Discount Products</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <a href="{{ route('add_product') }}" class="btn btn-info">Add New Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="example1" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Product Name</th>
                                        <th>Stock</th>
                                        <th>Previous Price</th>
                                        <th>Price</th>
                                        <th>Product Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php( $i = 0 )
                                    @foreach($products as $product)
                                    <tr class="@if(empty($product->stock)) bg-danger text-light @endif">
                                        <th>{{ $i += 1}}</th>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->previous_price }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->product_type }}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-info dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Action
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="{{ url('/cms/edit-Product/'.$product->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ url('/cms/deactive-product/'.$product->id) }}">Deactive</a>
                                                    <a class="dropdown-item" href="{{ url('/cms/product-variation/'.$product->id) }}">Variations</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
