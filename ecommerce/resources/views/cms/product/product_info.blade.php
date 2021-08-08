@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Product Info</h1>
    </div>
    <div class="row">
    <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <div class="author-box-center text-center">
                                <img alt="image" src="{{ asset($product->small_image) }}" class="rounded author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <h4><b>{{ $product->title }}</b></h4>
                                </div>
                                <div class="author-box-job">Url: {{ $product->short_description }}</div>
                                <div class="author-box-job">{{ $product->short_description }}</div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone 1:
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $product->phone_1 }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        phone 2:
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $product->phone_2 }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Email
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $product->email }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Facebook
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $product->facebook }}</a>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Youtube
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $product->youtube }}</a>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Instagram
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $product->instagram }}</a>
                                    </span>
                                </p>

                                <p class="clearfix">
                                    <span class="float-left">
                                        Twitter
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $product->twitter }}</a>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4><b>Others Info</b></h4>
                        </div>
                        <div class="card-body">
                            <h6 class="text-info"><b>Privacy & Policy: </b></h6>
                            {{ $product->privacy_policy }}
                            <br>
                            <h6 class="text-info"><b>Mission & Vision: </b></h6>
                            {{ $product->mission_and_vission }}

                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection
