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
            <div class="col-md-12">
                <div class="">
                    <div class="">
                        <div class="row">
                            <div class="col-md-12 card shadow p-2 bg-white rounded">
                                <div class="card-header">
                                    <h3><b>Terms & Conditions</b></h3>
                                </div>
                                <div class="card-body">
                                    <div class="text-justify">
                                        {!!$shop_s->Terms_and_conditions!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
