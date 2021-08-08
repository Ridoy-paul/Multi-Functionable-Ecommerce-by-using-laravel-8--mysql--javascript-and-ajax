@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Thana</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('/cms/update_thana/'.$thana->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span>Select
                                            District</label>
                                        <select id="" name="District_name" class="form-select form-control">
                                            <option>-- Select District --</option>
                                            @foreach($shippingCharges as $ship)
                                            <option @if($ship->id == $thana->ship_id) selected @endif
                                                value="{{$ship->id}}">{{$ship->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('District_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span>Thana Name With
                                            Zip
                                            Code</label>
                                        <input type="text" id="" value="{{$thana->shipping_sub_name}}"
                                            class="form-control" placeholder="Ex: Mirpur-10, 1216"
                                            name="shipping_sub_name" required />
                                        @error('shipping_sub_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success form-control">Submit</button>
                                </div>
                            </div>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection
