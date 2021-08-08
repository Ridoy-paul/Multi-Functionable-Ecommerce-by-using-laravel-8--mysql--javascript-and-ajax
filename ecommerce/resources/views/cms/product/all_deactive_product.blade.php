@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Deactive Products</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <a href="{{ route('add_product') }}" class="btn btn-danger">Add New Product</a>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php( $i = 0 )
                                    @foreach($products as $product)
                                        <tr>
                                            <th>{{ $i += 1}}</th>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->previous_price }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                <a href="{{ url('/cms/edit-Product/'.$product->id) }}" class="btn btn-danger btn-sm">Edit</a>
                                                <a href="{{ url('/cms/active-product/'.$product->id) }}" class="btn btn-success btn-sm">Active</a>
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
