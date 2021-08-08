@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Ads Banner</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('/cms/update_ads_banner/'.$banner->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $banner->image }}">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="first-name-column">Banner Title</label>
                                        <input type="text" id="" class="form-control" placeholder="" value="{{$banner->banner_title}}" name="banner_title"
                                            required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="first-name-column">Banner Image(620 X 277)</label>
                                        <input type="file" id="first-name-column" class="form-control"
                                            name="image" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="first-name-column">Previous Image</label><br>
                                        <img style="border-radius: 5px; border: 1px solid #F50057;" src="{{ asset($banner->image) }}" alt=""
                                            width="250">
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Serial Number</label>
                                        <input type="number" id="" class="form-control"
                                            value="{{ $banner->serial_num }}" placeholder="Ex: 1"
                                            name="serial_num" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success form-control">Submit</button>
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
