@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>All Shipping Thana</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#basicModal">Add New</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="example1" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>District Name</th>
                                        <th>Thana Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php( $i = 0 )
                                    @foreach($thanas as $thana)

                                    <tr>
                                        <th>{{ $i += 1}}</th>
                                        <td>{{ $thana->name }}</td>
                                        <td>{{ $thana->shipping_sub_name }}</td>
                                        <td>
                                            <a href="{{ url('/cms/editThana/'.$thana->id) }}"
                                                class="btn btn-info">Edit</a>
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

<!-- Begin:: This is the add new shipping modal -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('add_new_shipping_sub_area') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column"><span class="text-danger">*</span>Select District</label>
                                <select id="" name="District_name" class="form-select form-control">
                                    <option>-- Select District --</option>
                                    @foreach($shippingCharges as $ship)
                                    <option value="{{$ship->id}}">{{$ship->name}}</option>
                                    @endforeach
                                </select>
                                @error('District_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first-name-column"><span class="text-danger">*</span>Thana Name With Zip
                                    Code</label>
                                <input type="text" id="" class="form-control" placeholder="Ex: Mirpur-10, 1216"
                                    name="shipping_sub_name" required />
                                @error('shipping_sub_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End:: This is the add new shipping modal -->

@endsection
