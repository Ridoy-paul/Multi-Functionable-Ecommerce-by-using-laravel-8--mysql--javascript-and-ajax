@extends('user.user_master')
@section('user_content')

<section class="" style="background-color: #897777;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2 py-3">
                <h5><a href="/" class="text-dark">Home</a> › Cart</h5>
            </div>
        </div>
    </div>
</section>

<!-- <a href="{{url('/delete-product/'.$data['secPID'])}}" class="text-danger btn btn-dark btn-sm"><i
                                 class="fa fa-trash-o"></i></a> -->

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <select id="select_page" style="width:200px;" class="form-control">
                    <option value="">Select a Page...</option>
                    <option value="alpha">alpha</option>
                    <option value="beta">beta</option>
                    <option value="theta">theta</option>
                    <option value="omega">omega</option>
                </select>
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container -->
</section>
@endsection
