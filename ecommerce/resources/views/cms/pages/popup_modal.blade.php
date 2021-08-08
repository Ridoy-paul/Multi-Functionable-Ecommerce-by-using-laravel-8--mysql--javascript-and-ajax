@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Popup Modals</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(empty($popupModals->id))
                    <div class="card-body text-center">
                        <h1 class="text-warning"><b>Please Setup Setting First</b></h1>
                    </div>
                    @else
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                            @if(!empty($popupModals->popup_modal_title))
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#basicModal">Edit</button>
                            @else
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#basicModal">Add New Modal</button>
                            @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                        @if(!empty($popupModals->popup_modal_image))
                        <img alt="image" src="{{ asset($popupModals->popup_modal_image) }}" class="" style="width: 300px; border-radius: 10px;">
                        @else
                        <img alt="image" src="" class="author-box-picture">
                        @endif
                      <div class="clearfix"></div>
                      <br>
                      <div class="author-box-name">
                        <h4>{{ $popupModals->popup_modal_title }}</h4>
                      </div>
                      <div class="author-box-job"></div>
                    </div>
                    <div class="text-center">
                      <div class="author-box-description">
                        <p>
                        {{ $popupModals->popup_modal_description }}
                        </p>
                      </div>
                      
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Begin:: This is the add new popup modal modal -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ url('popup/update-popup/'.$popupModals->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-12 col-12">
                    <div class="form-group">
                                <label for="first-name-column">Modal Title</label>
                                <input type="text" id="category_name" class="form-control"
                                    placeholder="Modal Title" value="{{ $popupModals->popup_modal_title }}" name="title" required />
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Description</label>
                                    <textarea class="form-control"  required name="description" id="" cols="30" rows="6">{{ $popupModals->popup_modal_description }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-8">
                                <label for="first-name-column">Modal Image(400 X 400)</label>
                                <input type="file" id="first-name-column" class="form-control" name="popup_modal_image" />
                                <input type="hidden" id="" class="form-control" name="old_image" />
                            </div>

                            @if(!empty($popupModals->popup_modal_image))
                            <div class="form-group col-md-4 text-center">
                                <img alt="image" src="{{ asset($popupModals->popup_modal_image) }}" class="" style="width: 80px; border-radius: 10px;">
                            </div>
                            @endif
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
<!-- End:: This is the add new popup modal modal -->

@endsection
