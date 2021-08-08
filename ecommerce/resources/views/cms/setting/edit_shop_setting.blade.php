@extends('cms.cms_master')
@section('admin_content')

<section class="section">
    <div class="section-header">
        <h1>Update Company Settings</h1>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4></h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('update_shop_setting/'.$shop_setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"><span class="text-danger">*</span>Company Name</label>
                                <input type="text" class="form-control" id="" required name="shop_name"
                                    value="{{ $shop_setting->shop_name }}">
                                @error('shop_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4"><span class="text-danger">*</span>Address</label>
                                <input type="text" name="address" class="form-control" required id=""
                                value="{{ $shop_setting->address }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress"><span class="text-danger">*</span>Phone 1</label>
                                <input type="text" class="form-control" name="phone_1" required minlength="11"
                                    maxlength="11" id="" value="{{ $shop_setting->phone_1 }}" placeholder="Ex: 01627382866">
                                @error('phone_1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Phone 2</label>
                                <input type="text" minlength="11" value="{{ $shop_setting->phone_2 }}" maxlength="11" name="phone_2" class="form-control"
                                    id="" placeholder="Ex: 01627382866">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity"><span class="text-danger">*</span>Email</label>
                                <input type="email" class="form-control" required name="email" id=""
                                value="{{ $shop_setting->email }}" placeholder="Ex: info@gmail.com">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState"><span class="text-danger">*</span>Logo (205 X 65)</label>
                                <input type="file" name="logo" class="form-control" id="">
                                <input type="hidden" name="old_image" value="{{ $shop_setting->logo }}">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState"><span class="text-danger">*</span>Previous Logo</label><br>
                                <img src="{{ asset($shop_setting->logo) }}" >
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Facebook link</label>
                                <input type="text" value="{{ $shop_setting->facebook }}" class="form-control" name="facebook" id="" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Youtube link</label>
                                <input type="text" value="{{ $shop_setting->youtube }}" name="youtube" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Instagram link</label>
                                <input type="text" value="{{ $shop_setting->instagram }}" name="instagram" class="form-control" id="" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Twitter link</label>
                                <input type="text" value="{{ $shop_setting->twitter }}" name="twitter" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Privacy Policy</b></label>
                            <textarea name="editor1">{{ $shop_setting->privacy_policy }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Mission & Vission</b></label>
                            <textarea name="editor2">{{ $shop_setting->mission_and_vission }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Terms & Conditions</b></label>
                            <textarea name="editor3">{{ $shop_setting->Terms_and_conditions }}</textarea>
                        </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="form-control btn btn-success">Update</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</section>

@endsection
