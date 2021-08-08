@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Sub-Category</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('update_Subcategory/'.$Subcategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span> Select
                                            Category</label>
                                        <select class="form-control" name="catID" required>
                                            <option>Select Category</option>
                                            @foreach($categories as $category)
                                            <option @if($category->id == $Subcategory->catID) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('catID')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span>Sub-Category
                                            Name</label>
                                        <input type="text" id="category_name" class="form-control"
                                            placeholder="Sub-Category Name" value="{{ $Subcategory->sub_cat_name }}" name="sub_cat_name" required />
                                        @error('sub_cat_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="first-name-column"><span class="text-danger">*</span> Url</label>
                                        <input type="text" id="category_url" value="{{ $Subcategory->url }}" class="form-control" name="url" required />
                                        @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

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
    </div>
</section>
@endsection
