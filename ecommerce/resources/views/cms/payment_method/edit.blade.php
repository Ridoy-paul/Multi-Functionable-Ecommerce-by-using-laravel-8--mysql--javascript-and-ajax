@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Payment Method</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ url('/cms/update_p_method/'.$pmethod->id) }}" method="POST">
                            @csrf
                            <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Method Name</label>
                                <input type="text" id="" class="form-control"
                                    value="{{optional($pmethod)->method_name}}" name="method_name" required />
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first-name-column">Number</label>
                                <input type="text" value="{{optional($pmethod)->number}}" class="form-control"
                                    name="number" required/>
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-success">Update</button>
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
