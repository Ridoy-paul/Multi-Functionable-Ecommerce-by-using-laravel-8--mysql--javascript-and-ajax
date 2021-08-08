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
                        <form class="form" action="{{ url('/cms/update_promo_code/'.$promo->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Promo Code</label>
                                    <input type="text" value="{{$promo->code}}" class="form-control" placeholder=""
                                        name="code" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Promotion
                                        Type</label>
                                    <select class="form-select form-control" name="discount_type">
                                        <option @if($promo->discount_type == 'Fixed') selected @endif value="Fixed"
                                            >Fixed</option>
                                        <option @if($promo->discount_type == 'Percentage') selected @endif
                                            value="Percentage">Percentage( % )</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Discount
                                        Amount</label>
                                    <input type="number" value="{{$promo->d_amount}}" class="form-control"
                                        name="d_amount" step=any required />
                                </div>
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Max Amount</label>
                                    <input type="number" value="{{$promo->max_d_amount}}" class="form-control"
                                        name="max_d_amount" step=any required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Minimum Buying
                                        amount</label>
                                    <input type="number" class="form-control" value="{{$promo->m_buy_amount}}" name="m_buy_amount" step=any required />
                                </div>
                                <div class="col-md-6">
                                    <label for="last-name-column"><span class="text-danger">*</span>Expire Date</label>
                                    <input type="date" value="{{$promo->expire_date}}" id="last-name-column"
                                        class="form-control" name="expire_date" />
                                    @error('expire_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="first-name-column"><span class="text-danger">*</span>Status</label>
                                    <select class="form-select form-control" name="active">
                                        <option @if($promo->active == 1) selected @endif value="1" >Published
                                        </option>
                                        <option @if($promo->active == 0) selected @endif value="0">Unpublished</option>
                                    </select>
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
