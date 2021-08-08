@extends('cms.cms_master')
@section('admin_content')

@php
$shop_s = DB::table('shop_settings')->first();

@endphp

<section class="section">
    <div class="section-header">
        <h1>Company Settings</h1>
        @if(!empty($shop_s->id))
        <div class="section-header-breadcrumb">
            <a href="{{ url('cms/edit-shop-setting/'.$shop_s->id) }}" class="btn btn-warning btn-sm">Edit</a>
        </div>
        @endif
    </div>

    <div class="row">
        @if(!empty($shop_s->id))
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shop Info</h4>
                        </div>
                        <div class="card-body">
                            <div class="author-box-center text-center">
                                <img alt="image" src="{{ asset($shop_s->logo) }}" class="rounded author-box-picture">
                                <div class="clearfix"></div>
                                <div class="author-box-name">
                                    <h4><b>{{ $shop_s->shop_name }}</b></h4>
                                </div>
                                <div class="author-box-job">{{ $shop_s->address }}</div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-body">
                            <div class="py-4">
                                <p class="clearfix">
                                    <span class="float-left">
                                        Phone 1:
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $shop_s->phone_1 }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        phone 2:
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $shop_s->phone_2 }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Email
                                    </span>
                                    <span class="float-right text-muted">
                                        {{ $shop_s->email }}
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Facebook
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $shop_s->facebook }}</a>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Youtube
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $shop_s->youtube }}</a>
                                    </span>
                                </p>
                                <p class="clearfix">
                                    <span class="float-left">
                                        Instagram
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $shop_s->instagram }}</a>
                                    </span>
                                </p>

                                <p class="clearfix">
                                    <span class="float-left">
                                        Twitter
                                    </span>
                                    <span class="float-right text-muted">
                                        <a href="#">{{ $shop_s->twitter }}</a>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4><b>Others Info</b></h4>
                        </div>
                        <div class="card-body">
                            <h4 class="text-info"><b>Privacy & Policy: </b></h4>
                            {!!$shop_s->privacy_policy!!}
                            <hr>
                            <h4 class="text-info"><b>Mission & Vision: </b></h4>
                            {!!$shop_s->mission_and_vission!!}
                            <hr>
                            <h4 class="text-info"><b>Terms & Conditions: </b></h4>
                            {!!$shop_s->Terms_and_conditions!!}
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @else
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('shop_setting_set') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"><span class="text-danger">*</span>Company Name</label>
                                <input type="text" class="form-control" id="" required name="shop_name"
                                    placeholder="Ex: FARA IT Fusion">
                                @error('shop_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4"><span class="text-danger">*</span>Address</label>
                                <input type="text" name="address" class="form-control" required id=""
                                    placeholder="Ex: Company Address">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress"><span class="text-danger">*</span>Phone 1</label>
                                <input type="text" class="form-control" name="phone_1" required minlength="11"
                                    maxlength="11" id="" placeholder="Ex: 01627382866">
                                @error('phone_1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress2">Phone 2</label>
                                <input type="text" minlength="11" maxlength="11" name="phone_2" class="form-control"
                                    id="" placeholder="Ex: 01627382866">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity"><span class="text-danger">*</span>Email</label>
                                <input type="email" class="form-control" required name="email" id=""
                                    placeholder="Ex: info@gmail.com">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState"><span class="text-danger">*</span>Logo (205 X 65)</label>
                                <input type="file" name="logo" required class="form-control" id="">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Facebook link</label>
                                <input type="text" class="form-control" name="facebook" id="" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Youtube link</label>
                                <input type="text" name="youtube" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Instagram link</label>
                                <input type="text" name="instagram" class="form-control" id="" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputState">Twitter link</label>
                                <input type="text" name="twitter" class="form-control" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Privacy Policy</b></label>
                            <textarea name="editor1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Mission & Vission</b></label>
                            <textarea name="editor2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Terms & Conditions</b></label>
                            <textarea name="editor3"></textarea>
                        </div>
                        

                </div>
                <div class="card-footer">
                    <button type="submit" class="form-control btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>

        @endif
    </div>

</section>

@endsection
