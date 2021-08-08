@extends('cms.cms_master')
@section('admin_content')
@php
    $shop_s = DB::table('shop_settings')->first();
@endphp
<section class="section">
    <div class="section-header">
        <h1>Campaings and Wallet</h1>
        <div class="section-header-breadcrumb">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Wallet Points Data</button>
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#basicModal">Add New</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="example2" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Campaign Name</th>
                                        <th>Active Status</th>
                                        <th>Campaign Type</th>
                                        <th>Point or TK</th>
                                        <th>Wallet Amount</th>
                                        <th>Max Buying Amount</th>
                                        <th>Start Date</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php( $i = 0 )
                                    @foreach($allWallets as $wallet)
                                    @php( $exp_date = date("d M, Y", strtotime($wallet->exp_date)) )
                                    @php( $startDate = date("d M, Y", strtotime($wallet->start_date)))
                                    <tr>
                                        <th>{{ $i += 1}}</th>
                                        <td>{{ $wallet->campaign_name }}</td>
                                        @if($wallet->active == 1)
                                        <td>
                                            <h4><span class="badge bg-success text-light">Published</span></h4>
                                        </td>
                                        @else
                                        <td>
                                            <h4><span class="badge bg-danger">Unpublished</span></h4>
                                        </td>
                                        @endif
                                        <td>{{ $wallet->type }}</td>
                                        <td>{{ $wallet->point_or_tk }}</td>
                                        <td>{{ $wallet->price_amount }}</td>
                                        <td>{{ $wallet->maximum_buy }}</td>
                                        <td>{{ $startDate }}</td>
                                        <td>{{ $exp_date }}</td>
                                        <td>
                                            <a href="{{ url('/cms/edit-campaign/'.$wallet->id) }}"
                                                class="btn btn-info">Edit</a>
                                        </td>
                                    </tr>
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

<!-- Begin:: This is the add new promoCode modal -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Campaign</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('add_wallet') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="first-name-column"><span class="text-danger">*</span>Campaign Name</label>
                            <input type="text" id="" class="form-control" placeholder="" name="campaign_name" required />
                            @error('campaign_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="first-name-column"><span class="text-danger">*</span>Campaign Type</label>
                            <select class="form-select form-control" name="type">
                                <option value="sell" selected>Sell</option>
                                <option value="registration">Registration</option>
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
                                <option value="point">Point</option>
                                <option value="tk">Tk</option>
                            </select>
                            @error('point_or_tk')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="first-name-column">Amount</label>
                            <input type="number" class="form-control" name="price_amount" step=any required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="first-name-column">Minimum Buy (Only for Campaign type Sell)</label>
                            <input type="number" class="form-control" name="maximum_buy" step=any />
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    <div class="col-md-6">
                            <label for="last-name-column"><span class="text-danger">*</span>Start Date</label>
                            <input type="date" id="last-name-column" class="form-control" name="start_date" required/>
                            @error('expire_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last-name-column"><span class="text-danger">*</span>Expire Date</label>
                            <input type="date" id="last-name-column" class="form-control" name="exp_date" required/>
                            @error('expire_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="first-name-column"><span class="text-danger">*</span>Status</label>
                            <select class="form-select form-control" name="active">
                                <option value="1" selected>Published</option>
                                <option value="0">Unpublished</option>
                            </select>
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
<!-- End:: This is the add new promoCode modal -->

<!-- Begin:: Wallet Points DAta Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wallet Points Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p><b>⭐Minimum Points to convert: </b> <span class="text-info"> @if(!empty($shop_s->minimum_point_to_convert)) {{$shop_s->minimum_point_to_convert}} @else Not Set @endif </span></p>
      <p><b>⭐Points to taka convert rate: </b> <span class="text-info"> @if(!empty($shop_s->point_to_tk_convert_rate)) {{$shop_s->point_to_tk_convert_rate}} @else Not Set @endif </span></p>
      <!-- <p><b>⭐Purchase Point: </b> <span class="text-info"> @if(!empty($shop_s->purchase_point)) {{$shop_s->purchase_point}} @else Not Set @endif </span></p> -->
      <p><b>⭐Use how many percent of wallet balance: </b> <span class="text-info"> @if(!empty($shop_s->minimum_purchase_amount_in_tk_use_wallet_bl)) {{$shop_s->minimum_purchase_amount_in_tk_use_wallet_bl}} @else Not Set @endif </span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateWalletSettingMOdal">Update</button>

      </div>
    </div>
  </div>
</div>
<!-- Begin:: Wallet Points DAta Modal -->

<!-- Modal -->
<div class="modal fade" id="updateWalletSettingMOdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Wallet Data Setting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="form" action="{{ url('/cms/update-wallet-setting/'.$shop_s->id) }}" method="POST">
        @csrf
      <div class="row">
      <div class="form-group col-md-12">
            <label for="first-name-column"><span class="text-danger">*</span>Minimum Points to convert</label>
            <input type="text" value="{{$shop_s->minimum_point_to_convert}}" class="form-control"  name="minimum_point_to_convert" required />
        </div>
        <div class="form-group col-md-12">
            <label for="first-name-column"><span class="text-danger">*</span>Points to taka convert rate (1 point in taka ? EX - 1 or 0.80)</label>
            <input type="text" value="{{$shop_s->point_to_tk_convert_rate}}" class="form-control"  name="point_to_tk_convert_rate" required />
        </div>
        <!-- <div class="form-group col-md-12">
            <label for="first-name-column"><span class="text-danger">*</span>Purchase Point (Example : For 1 taka purchase 1 point or 0.50 Point)</label>
            <input type="hidden" value="{{$shop_s->purchase_point}}" class="form-control"  name="purchase_point" required />
        </div> -->
        <input type="hidden" value="0" class="form-control"  name="purchase_point"/>
        <div class="form-group col-md-12">
            <label for="first-name-column"><span class="text-danger">*</span>Use how many percent of wallet balance</label>
            <input type="number" step=any value="{{$shop_s->minimum_purchase_amount_in_tk_use_wallet_bl}}" max="100" class="form-control" placeholder="20"  name="minimum_purchase_amount_in_tk_use_wallet_bl" required />
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection
