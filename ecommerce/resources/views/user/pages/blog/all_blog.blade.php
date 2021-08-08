@extends('user.user_master')
@section('user_content')
@php

$lastID = 0;

@endphp
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">

            </div>
        </div>
    </div>
</section>

<!-- section start -->
<section class="section-big-py-space blog-page ratio2_3">
    <div class="container">
        <div class="row" id="blog_body">
            @foreach($blogs as $blog)
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <a href="{{url('/blog/'.$blog->id.'/'.$blog->url)}}"><img class="card-img-top img-fluid" src="{{asset($blog->image)}}" alt="{{optional($blog)->alt}}"></a>
                        <div class="card-body">
                            <h5 style="text-align: justify;" class="card-title"><a href="{{url('/blog/'.$blog->id.'/'.$blog->url)}}">{{$blog->title}}</a></h5>
                            <p style="color: #FF6000;">Date: {{ date('d M, Y', strtotime($blog->date))}} | Posted By: {{$blog->author}}</p><br>
                            <p style="text-align: justify;" class="card-text">{{substr(strip_tags($blog->description), 0, 120)}}....</p>
                        </div>
                    </div>
                </div>
                @php( $lastID = $blog->id)
            @endforeach
        </div>
        @if($lastID > 1)
        <div class="row" id="LoadMoreButtonRow">
            <div class="col-md-12">
                <hr>
                <button style="float: right;" onclick="BlogLoadMore()" class="btn cart-btn btn-normal">Load More</button>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Section ends -->

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <input type="hidden" name="" id="BlogLastID" value="{{$lastID}}">
            </div>
        </div>
    </div>
</section>


@endsection
