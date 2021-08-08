@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Slider</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('/cms/update_slider/'.$slider->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $slider->image }}">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Slider Title</label>
                                        <input type="text" value="{{ $slider->slider_title }}" class="form-control"
                                            placeholder="" name="slider_title" />
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column">Meta Title</label>
                                        <input type="text" id="" value="{{ $slider->meta_title }}" class="form-control"
                                            placeholder="Meta Title" name="meta_title" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first-name-column">Slider New Image(1050 X 355)</label>
                                    <input type="file" id="first-name-column" class="form-control"
                                        placeholder="Category Name" name="image" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="first-name-column">Previous Image</label><br>
                                    <img style="border-radius: 5px;" src="{{ asset($slider->image) }}" alt=""
                                        width="300">
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success form-control">Submit</button>
                                </div>
                            </div>
                            </div>


                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
