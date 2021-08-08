@extends('cms.cms_master')
@section('admin_content')
@php
$images = \File::allFiles(public_path('images/product'));
@endphp
<section class="section">
    <div class="section-header">
        <h1>Products File Manager</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#basicModal">Add New File</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($images as $image)
                        <li style="display:inline-block;padding:5px 5px;">
                            <img class="lozad" onclick="copyImageUrl('images/product/{{$image->getFilename()}}')"
                                src="{{ asset('images/product/' . $image->getFilename()) }}" width="80">
                        </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Begin:: This is the add new category modal -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Product Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('FileManager_Add_new_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column"><span class="text-danger">*</span>Used For</label>
                                <select class="form-select form-control" required name="smORlg">
                                <option value="">Select One</option>
                                    <option value="sm">Product Small Image( 250 X 248 )</option>
                                    <option value="lg">Product Large Image(450 X 595)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Image</label>
                                <input type="file" id="first-name-column" class="form-control"
                                    placeholder="Category Name" name="image" required />
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End:: This is the add new category modal -->

@endsection
