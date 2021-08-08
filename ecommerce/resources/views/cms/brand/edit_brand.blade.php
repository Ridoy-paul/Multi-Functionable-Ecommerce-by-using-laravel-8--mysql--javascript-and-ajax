@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Brand</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('update_brand/'.$brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $brand->image }}">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Brand Name</label>
                                        <input type="text" id="category_name" class="form-control"
                                           value="{{ $brand->brand_name }}" name="brand_name" required />
                                    </div>
                                    @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                    <label for="first-name-column">Url</label>
                                    <input type="text" id="category_url" class="form-control" value="{{ $brand->url }}"
                                        name="url" required/>
                                        @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="first-name-column">Brand Image(108 X 108)</label>
                                            <input type="file" id="first-name-column" class="form-control"
                                                placeholder="brand Name" name="image" />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label for="first-name-column">Previous Image</label><br>
                                            <img style="border-radius: 5px;" src="{{ asset($brand->image) }}" alt="" width="70" height="70">
                                        </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success form-control">Update</button>
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
