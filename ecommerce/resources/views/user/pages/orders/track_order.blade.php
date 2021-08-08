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

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('user.trackorder')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="orderID" required 
                                            placeholder="Order ID">
                                    </div>
                                </div>
                                <div class="col-md-2"><button type="submit" class="btn btn-primary btn-block">Search</button></div>
                            </div>
                        </form>

                        @if(!empty($order->invID))
                        <div class="row">
                            <div class="col-md-12 card">
                                <div style="padding: 20px;">
                                    <h2><b class="text-info">Name: </b>{{$order->name}}</h2>
                                    <h2><b class="text-info">Order Status: </b>{{$order->order_status}}</h2>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-2"></div>
        </div>
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
