@php
$sliders = DB::table('sliders')->get();
@endphp

<section class="theme-slider section-py-space home-slide">
    <div class="custom-container">
        <div class="row slider-layout-4">
            <div class="col-xl-10 slider-slide ">
                <div class="slide-1 no-arrow">
                @foreach($sliders as $slider)
                    <div>
                        <div class="slider-banner slide-banner-3">
                            <div class="slider-img">
                                <ul>
                                    <li><img id="img-1" src="{{ asset($slider->image) }}" class="img-fluid" alt="{{$slider->meta_title}}"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
