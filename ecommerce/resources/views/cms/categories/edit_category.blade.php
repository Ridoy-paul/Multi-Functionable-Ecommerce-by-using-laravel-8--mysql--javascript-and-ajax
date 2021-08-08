@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Categories</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('update_category/'.$category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $category->image }}">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Category Name</label>
                                        <input type="text" id="category_name" class="form-control"
                                           value="{{ $category->name }}" name="name" required />
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group">
                                    <label for="first-name-column">Url</label>
                                    <input type="text" id="category_url" class="form-control" value="{{ $category->url }}"
                                        name="url" required/>
                                        @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                
                                </div>
                                <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="first-name-column">Category Image(39 X 39)</label>
                                            <input type="file" id="first-name-column" class="form-control"
                                                placeholder="Category Name" name="image" />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label for="first-name-column">Previous Image</label><br>
                                            <img style="border-radius: 5px;" src="{{ asset($category->image) }}" alt="" width="39" height="39">
                                        </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="last-name-column">Serial Number</label>
                                        <input type="number" id="last-name-column" class="form-control"
                                        value="{{ $category->serial_number }}"  placeholder="Ex: 1" name="serial_number" />
                                    </div>
                                </div>
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
