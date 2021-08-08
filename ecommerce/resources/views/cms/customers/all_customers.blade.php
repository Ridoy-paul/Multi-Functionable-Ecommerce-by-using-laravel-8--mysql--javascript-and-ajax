@extends('cms.cms_master')
@section('admin_content')
@php

function GetDistrict($id){
    $dis = DB::table('shipping_charges')->where('id', $id)->first();
    echo $dis->name;
}

function GetThana($id) {
    $dis = DB::table('shipping_sub_areas')->where('id', $id)->first();
    echo $dis->shipping_sub_name;
}

@endphp
<section class="section">
    <div class="section-header">
        <h1>All Customers</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="example1" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Customer Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>District</th>
                                        <th>Thana</th>
                                        <th>Address</th>
                                        <th>Point</th>
                                        <th>Balance Tk</th>
                                        <th>verify Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php( $i = 0 )
                                    @foreach($customers as $customer)
                                        <tr>
                                            <th>{{ $i += 1}}</th>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td> @if(!empty($customer->district)) {{GetDistrict($customer->district)}} @else <b class="text-danger">Not Set</b> @endif</td>
                                            <td> @if(!empty($customer->thana)) {{GetThana($customer->thana)}} @else <b class="text-danger">Not Set</b> @endif</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->point+0 }}</td>
                                            <td>{{ $customer->balance+0 }}</td>
                                            @if($customer->active == 'active')
                                            <td><p class="text-success text-bold">Verified</p></td>
                                            @else
                                            <td><p class="text-danger">Not Verified</p></td>
                                            @endif
                                            
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
