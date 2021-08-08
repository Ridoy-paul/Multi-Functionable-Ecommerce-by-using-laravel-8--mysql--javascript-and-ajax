@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Variation Of {{ $product->title }}</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h6><b>Variations Type:</b></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($variations as $variation)
                        <button type="button" class="btn btn-info btn-block mt-2"
                            onclick="AddVariation('{{ $variation->id }}', '{{ $variation->vari_name }}')">Add
                            {{ $variation->vari_name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('set_variations') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <table class="table" id="variation_table">
                            <thead>
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="40%">Attribute</th>
                                    <th width="30%">Price ( <span class="text-danger">Leave blank if not required</span>)</th>
                                    <th class="text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($exist_variations as $exist_variation)
                                @php 
                                    $vari_name = strtolower($exist_variation->vari_name);
                                    if($vari_name == 'color' || $vari_name == 'colour') {
                                    @endphp
                                        <tr id="exist_vari{{ $exist_variation->id }}">
                                            <td><input type="hidden" id="product_variation_id" name="product_variation_id[]" value="{{ $exist_variation->id }}"><input type="hidden" name="variation_id[]" value="{{ $exist_variation->variation_id }}">{{ $exist_variation->vari_name }}</td>
                                            <td><input type="color" name="attribute[]" class="form-control" value="{{ $exist_variation->attribute_name }}"></td>
                                            <td><input type="number" name="price[]" class="form-control" value="{{ $exist_variation->price }}" step=any></td>
                                            <td class="text-center"><i onclick="dbDeleteRow('{{ $exist_variation->id }}')" style="font-size: 20px;" class="fas fa-trash-alt text-danger" aria-hidden="true"></i></td>
                                        </tr>
                                    @php
                                    }
                                    else {
                                    @endphp
                                        <tr id="exist_vari{{ $exist_variation->id }}">
                                            <td><input type="hidden" id="product_variation_id" name="product_variation_id[]" value="{{ $exist_variation->id }}"><input type="hidden" name="variation_id[]" value="{{ $exist_variation->variation_id }}">{{ $exist_variation->vari_name }}</td>
                                            <td><input type="text" name="attribute[]" class="form-control" value="{{ $exist_variation->attribute_name }}"></td>
                                            <td><input type="number" name="price[]" class="form-control" value="{{ $exist_variation->price }}" step=any></td>
                                            <td class="text-center"><i onclick="dbDeleteRow('{{ $exist_variation->id }}')" style="font-size: 20px;" class="fas fa-trash-alt text-danger" aria-hidden="true"></i></td>
                                        </tr>
                                    @php
                                    }
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" value="{{ $product->id }}" name="product_unique_id">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
