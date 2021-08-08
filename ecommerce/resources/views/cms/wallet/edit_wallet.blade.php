@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Wallet Campaign</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('/cms/update-campaign-wallet/'.$wallet->id) }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Campaign
                                        Name</label>
                                    <input type="text" value="{{$wallet->campaign_name}}" class="form-control" placeholder="" name="campaign_name"
                                        required />
                                    @error('campaign_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Campaign
                                        Type</label>
                                    <select class="form-select form-control" name="type">
                                        <option @if($wallet->type == 'sell') selected @endif value="sell" >Sell</option>
                                        <option @if($wallet->type == 'registration') selected @endif value="registration">Registration</option>
                                    </select>
                                    @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="first-name-column"><span class="text-danger">*</span>Point Or Tk</label>
                                    <select class="form-select form-control" name="point_or_tk">
                                        <option @if($wallet->point_or_tk == 'point') selected @endif value="point">Point</option>
                                        <option @if($wallet->point_or_tk == 'tk') selected @endif value="tk">Tk</option>
                                    </select>
                                    @error('point_or_tk')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="first-name-column">Amount</label>
                                    <input type="number" value="{{$wallet->price_amount}}" class="form-control" name="price_amount" step=any required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="first-name-column">Minimum Buy (Only for Campaign type Sell)</label>
                                    <input type="number" value="{{$wallet->maximum_buy}}" class="form-control" name="maximum_buy" step=any />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="last-name-column"><span class="text-danger">*</span>Start Date</label>
                                    <input type="date" value="{{$wallet->start_date}}" id="last-name-column" class="form-control" name="start_date"
                                        required />
                                    @error('expire_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last-name-column"><span class="text-danger">*</span>Expire Date</label>
                                    <input type="date" id="last-name-column" value="{{$wallet->exp_date}}" class="form-control" name="exp_date"
                                        required />
                                    @error('expire_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="first-name-column"><span class="text-danger">*</span>Status</label>
                                    <select class="form-select form-control" name="active">
                                        <option @if($wallet->active == 1) selected @endif value="1" >Published</option>
                                        <option @if($wallet->active == 0) selected @endif value="0">Unpublished</option>
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
