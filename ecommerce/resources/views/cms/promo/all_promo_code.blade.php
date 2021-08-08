@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Promo Codes</h1>
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
                                        <th>Promo Code</th>
                                        <th>Active Status</th>
                                        <th>Discount Type</th>
                                        <th>Discount Amount</th>
                                        <th>Max Amount</th>
                                        <th>Max Buying Amount</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php( $i = 0 )
                                    @foreach($promoCodes as $promoCode)
                                    @php( $exp_date = date("d M, Y", strtotime($promoCode->expire_date)) )
                                    <tr>
                                        <th>{{ $i += 1}}</th>
                                        <td>{{ $promoCode->code }}</td>
                                        @if($promoCode->active == 1)
                                        <td>
                                            <h4><span class="badge bg-success">Published</span></h4>
                                        </td>
                                        @else
                                        <td>
                                            <h4><span class="badge bg-danger">Unpublished</span></h4>
                                        </td>
                                        @endif
                                        <td>{{ $promoCode->discount_type }}</td>
                                        <td>{{ $promoCode->d_amount }}</td>
                                        <td>{{ $promoCode->max_d_amount }}</td>
                                        <td>{{ $promoCode->m_buy_amount }}</td>
                                        <td>{{ $exp_date }}</td>
                                        <td>
                                            <a href="{{ url('/cms/editpromoCode/'.$promoCode->id) }}"
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Promo Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('add_promoCode') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="first-name-column"><span class="text-danger">*</span>Promo Code</label>
                            <input type="text" id="" class="form-control" placeholder="" name="code" required />
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="first-name-column"><span class="text-danger">*</span>Promotion Type</label>
                            <select class="form-select form-control" name="discount_type">
                                <option value="Fixed" selected>Fixed</option>
                                <option value="Percentage">Percentage( % )</option>
                            </select>
                            @error('discount_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="first-name-column"><span class="text-danger">*</span>Discount Amount</label>
                            <input type="number" class="form-control" name="d_amount" step=any required />
                        </div>
                        <div class="col-md-6">
                            <label for="first-name-column">Max Amount</label>
                            <input type="number" class="form-control" name="max_d_amount" step=any />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="first-name-column"><span class="text-danger">*</span>Minimum Buying amount</label>
                            <input type="number" class="form-control" name="m_buy_amount" step=any required />
                        </div>
                        <div class="col-md-6">
                            <label for="last-name-column"><span class="text-danger">*</span>Expire Date</label>
                            <input type="date" id="last-name-column" class="form-control" name="expire_date" />
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

@endsection
