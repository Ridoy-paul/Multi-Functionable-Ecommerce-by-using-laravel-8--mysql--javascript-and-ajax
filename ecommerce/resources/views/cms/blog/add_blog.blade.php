@extends('cms.cms_master')
@section('admin_content')

<section class="section">
    <div class="section-header">
        <h1>Add New Blog</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4></h4>
                </div>
                <div class="card-body">
                    <form action="{{route('cms.add_blog')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4"><span class="text-danger">*</span>Title</label>
                                <input type="text" class="form-control" id="category_name" required name="title">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4"><span class="text-danger">*</span>Url</label>
                                <input type="text" name="url" class="form-control" required id="category_url">
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress"><span class="text-danger">*</span>Image( 345 X 205 )</label>
                                <input type="file" class="form-control" name="image" required>
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Alt</label>
                                <input type="text" name="alt" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputState"><b><span class="text-danger">*</span>Description</b></label>
                                <textarea name="editor1" required></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputAddress2">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputState"><b>Meta Description</b></label>
                                <textarea name="editor2"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity"><span class="text-danger">*</span>Author</label>
                                <input type="text" name="author"  class="form-control" id="" required>
                                @error('author')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState"><span class="text-danger">*</span>Date</label>
                                <input type="date" name="date" class="form-control" required>
                                @error('date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="form-control btn btn-success">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</section>

@endsection
