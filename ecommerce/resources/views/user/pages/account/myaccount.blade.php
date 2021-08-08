@extends('user.user_master')
@section('user_content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            </div>
        </div>
    </div>
</section>
@php
$userID = Cookie::get('user_id');
$userName = Cookie::get('user_name');
$userQ = DB::table('users')->where('id', $userID)->first();
$thana = DB::table('shipping_sub_areas')->where('id', $userQ->thana)->first();
$distQ = DB::table('shipping_charges')->where('id', $userQ->district)->first();
@endphp

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->

                    <div class="card-body text-center">
                        <i style="font-size: 110px;" class="fas fa-user-circle"></i>
                        <h3 class="card-title">{{$userName}}<i class="fas fa-check-circle text-success"></i></h3>

                        <div class="row">
                            <div class="col-md-6 col-6">
                                <p style="border-top: 2px; border-bottom: 2px; border-radius: 15px; font-size: 15px; background-color: #544AF4;"
                                    class="card-text pl-5 pr-5 text-light">P {{number_format($userQ->point, 2)}}</p>
                            </div>
                            <div class="col-md-6 col-6">
                                <p style="border-top: 2px; border-bottom: 2px; border-radius: 15px; font-size: 15px; background-color: #544AF4;"
                                    class="card-text pl-5 pr-5 text-light">৳ {{number_format($userQ->balance, 2)}}</p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('/convertPtoTK')}}" class="btn btn-success btn-sm"
                                    style="border-radius: 30px;"><i class="fas fa-sync-alt"></i> Convert</a>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{route('user.all.orders')}}" style="border-radius: 30px;"  class="btn btn-warning btn-sm btn-block">Orders</a></li>
                    <li class="list-group-item"><a href="{{route('user.myaccount')}}" style="border-radius: 30px;"  class="btn btn-warning btn-sm btn-block">Account Info</a></li>
                        
                    </ul>
                    @if(empty($editprofile))
                    <div class="card-body">
                        <a href="{{route('user.editAccount')}}" class="btn btn-outline-success btn-lg btn-block"
                            style="border-radius: 30px;">Update Profile</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                @if(!empty($editprofile))
                @php
                $shippingCharges = DB::table('shipping_charges')->orderBy('name', 'asc')->get();
                @endphp
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <h3><b>Update Profile</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/update-userprofile/'.$userQ->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{optional($userQ)->name}}" required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" readonly maxlength="11" name="phone" minlength="11"
                                            class="form-control" value="{{optional($userQ)->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" readonly class="form-control" name="email"
                                            value="{{optional($userQ)->email}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span> জেলা /
                                            District</label>
                                        <select id="checkoutDistrict" name="district" class="form-select js-example-basic-single" required>
                                            <option value="0">-- Select District --</option>
                                            @foreach($shippingCharges as $ship)
                                            <option @if($ship->id == $userQ->district) selected @endif
                                                value="{{$ship->id}}">{{$ship->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('district')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span> এরিয়া /
                                            Area</label>
                                        <select id="checkoutThanas" name="checkoutThana" class="form-select js-example-basic-single" required>
                                            <option value="{{optional($thana)->id}}">
                                                {{optional($thana)->shipping_sub_name}}</option>
                                        </select>
                                        @error('checkoutThana')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span> পুরো
                                            ঠিকানা/Full
                                            Address</label>
                                        <textarea class="form-control" id="" name="address" rows="2"
                                            required>{{optional($userQ)->address}}</textarea>
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @elseif(!empty($customerOrder))
                @php
                    $i = 1;
                    $orders = DB::table('orders')->where('userID', $userQ->id)->orderBy('id', 'desc')->get();
                @endphp
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <h3><b>All Orders</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">SI</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$order->invID}}</td>
                                        <td>{{ date('d M, Y', strtotime($order->date))}}</td>
                                        <td class="text-capitalize">{{$order->order_status}}</td>
                                        <td><a href="{{url('/orders/'.$order->invID)}}" style="border-radius: 30px;"  class="btn btn-danger btn-sm">Details</a></td>
                                    </tr>
                                    @php( $i += 1 )
                                @endforeach
                                
                            </tbody>
                            </table>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <h3><b>Profile Information</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Name: @if(!empty($userQ->name)) {{$userQ->name}} @else <span
                                class="text-danger">Not Set</span> @endif</h5>
                        <h5 class="card-title">Email: @if(!empty($userQ->email)){{$userQ->email}} @else <span
                                class="text-danger">Not Set</span> @endif</h5>
                        <h5 class="card-title">Phone: @if(!empty($userQ->phone)){{$userQ->phone}} @else <span
                                class="text-danger">Not Set</span> @endif</h5>
                        <h5 class="card-title">District: @if(!empty($userQ->district)) {{optional($distQ)->name}} @else <span
                                class="text-danger">Not Set</span> @endif</h5>
                        <h5 class="card-title">Thana: @if(!empty($userQ->thana)) {{optional($thana)->shipping_sub_name}} @else <span
                                class="text-danger">Not Set</span> @endif</h5>
                        <h5 class="card-title">Address: @if(!empty($userQ->address)){{$userQ->address}} @else <span
                                class="text-danger">Not Set</span> @endif</h5>
                    </div>
                </div>
                @endif
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container -->
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            </div>
        </div>
    </div>
</section>

@endsection
