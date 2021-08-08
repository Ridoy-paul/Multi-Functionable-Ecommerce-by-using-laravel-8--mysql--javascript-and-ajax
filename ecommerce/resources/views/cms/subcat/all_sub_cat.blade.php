@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>All Sub-Categories</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#basicModal">Add New Sub-Category</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#deactiveModal">Deactive Sub-Categories</button>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="example1" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Sub-Category Name</th>
                                        <th>Url</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php( $i = 0 )
                                    @foreach($Sub_categories as $Sub_category)
                                    @if($Sub_category->active == 1)
                                    <tr>
                                        <th>{{ $i += 1}}</th>
                                        <td>{{ $Sub_category->sub_cat_name }}</td>
                                        <td>{{ $Sub_category->url }}</td>
                                        <td>{{ $Sub_category->name }}</td>
                                        <td>
                                            <a href="{{ url('editSubCategory/'.$Sub_category->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ url('DeactiveSubCategory/'.$Sub_category->id) }}"
                                                class="btn btn-warning">Deactive</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Sub-Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('add_sub_category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                            <label for="first-name-column"><span class="text-danger">*</span> Select Category</label>
                                <select class="form-control" name="catID" required>
                                <option >Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('catID')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column"><span class="text-danger">*</span> Sub-Category Name</label>
                                <input type="text" id="category_name" class="form-control" placeholder="Sub-Category Name"
                                    name="sub_cat_name" required />
                                    @error('sub_cat_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="first-name-column"><span class="text-danger">*</span> Url</label>
                                <input type="text" id="category_url" class="form-control" name="url" required />
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
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

<!-- Begin:: This is the All Deactive category modal -->
<div class="modal fade" id="deactiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deactive Sub-Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Sub-Category Name</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php( $i = 0 )
                                    @foreach($Sub_categories as $Sub_category)
                                    @if($Sub_category->active == 0)
                                    <tr>
                                        <th>{{ $i += 1}}</th>
                                        <td>{{ $Sub_category->sub_cat_name }}</td>
                                        <td>{{ $Sub_category->name }}</td>
                                        <td>
                                            <a href="{{ url('ActiveSubCategory/'.$Sub_category->id) }}"
                                                class="btn btn-primary">Active</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End:: This is the All Deactive category modal -->

@endsection
