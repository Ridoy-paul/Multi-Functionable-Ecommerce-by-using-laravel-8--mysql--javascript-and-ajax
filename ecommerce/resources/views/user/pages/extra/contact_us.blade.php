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
                            <div class="col-md-5 card shadow p-2 mb-3 bg-white rounded">
                                <div class="card-header">
                                    <h4><b>Reach Us</b></h4>
                                </div>
                                <div class="card-body">
                                    <div class="footer-box">
                                        <div class="footer-contant">
                                            <ul class="contact-list">
                                                <li><i class="fa fa-map-marker"></i>{{ $shop_s->address }}</li>
                                                <li><i class="fa fa-phone"></i>call us:
                                                    <span>{{ $shop_s->phone_1.", ".$shop_s->phone_2 }}</span></li>
                                                <li><i class="fa fa-envelope-o"></i>email us: {{ $shop_s->email }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 card shadow p-2 mb-3 bg-white rounded">
                                <div class="card-header">
                                    <h4><b>Our Location</b></h4>
                                </div>
                                <div class="card-body">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.336367518906!2d90.36683561448484!3d23.806635092543782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c10118a2eeb3%3A0x353bf2c6b4465ae!2sFara%20IT%20Fusion%20%7C%20Ultimate%20IT%20Solution%20in%20Bangladesh!5e0!3m2!1sen!2sbd!4v1628073971898!5m2!1sen!2sbd"
                                        height="300" width="100%" style="border:0;" allowfullscreen=""
                                        loading="lazy"></iframe>

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
