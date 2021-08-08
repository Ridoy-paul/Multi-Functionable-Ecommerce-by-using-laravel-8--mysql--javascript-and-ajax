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

<!--section start-->
<section class="blog-detail-page section-big-py-space ratio2_3">
    <div class="container">
        <div class="row section-big-pb-space">
            <div class="col-sm-12 blog-detail">
               <div class="creative-card">
                   <div class="row">
                       <div class="col-md-4">
                            <img src="{{asset($blog->image)}}" alt="{{optional($blog)->alt}}" class="img-fluid">
                       </div>
                       <div class="col-md-8">
                            <h3 >{{$blog->title}}</h3>
                            <ul class="post-social">
                                <li>{{ date('d M, Y', strtotime($blog->date))}}</li>
                                <li>Posted By : {{$blog->author}}</li>
                            </ul>
                       </div>
                   </div>
                   <p>{!!$blog->description!!}</p>
               </div>
            </div>
        </div>
       
    </div>
</section>
<!--Section ends-->

@endsection
