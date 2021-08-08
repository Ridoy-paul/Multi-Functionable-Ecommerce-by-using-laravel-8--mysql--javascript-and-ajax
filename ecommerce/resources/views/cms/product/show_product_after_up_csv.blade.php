@extends('cms.cms_master')
@section('admin_content')
@php

$brands = DB::table('brands')->get();
$categories = DB::table('categories')->get();
$sub_categories = DB::table('sub_categories')->get();

$ubrand = 0;
$ucat = 0;
$usubCat = 0;
@endphp
<section class="section">
    <div class="section-header">
        <h1>Uploadable Products</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="{{route('csv_info_to_upload')}}" method="post">
                                    @csrf
                                <table class="table table-striped table-hover" id="example2" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>SI</th>
                                            <th>Product Title</th>
                                            <th>Product Code/Sku</th>
                                            <th style="width: 150px !important;">Brand</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Discount Product?</th>
                                            <th>Previous Price</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Short Description</th>
                                            <th>Description</th>
                                            <th>Meta Title</th>
                                            <th>Meta Description</th>
                                            <th>Small Image</th>
                                            <th>Large Image 1</th>
                                            <th>Large Image 2</th>
                                            <th>Large Image 3</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                        $i = 1;
                                        $file = fopen($filename, "r");
                                        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
                                            if(!empty($getData[2])){
                                                $ubrand = $getData[2];
                                            }

                                            if(!empty($getData[3])){
                                                $ucat = $getData[3];
                                            }

                                            if(!empty($getData[4])){
                                                $usubCat = $getData[4];
                                            }
                                            
                                        @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><input type="text" value="{{$getData[0]}}" name="title[]">{{$getData[0]}}</td>
                                            <td><input type="text" value="{{$getData[1]}}" name="sku[]">@if(!empty($getData[1])){{$getData[1]}} @else <span class="text-danger">Not Set</span> @endif</td>
                                            <td>
                                                <select class="form-control" name="brandID[]">
                                                    <option value="">Select Brand</option>
                                                    @foreach($brands as $brand)
                                                    <option @if($brand->id == $ubrand) selected @endif value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="catID[]">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                    <option @if($category->id == $usubCat) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="subCatID[]">
                                                    <option value="">Select Sub Category</option>
                                                    @foreach($sub_categories as $sub_cat)
                                                    <option @if($sub_cat->id == $ucat) selected @endif value="{{ $sub_cat->id }}">{{ $sub_cat->sub_cat_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" value="{{$getData[5]}}" name="special_discount[]">@if(!empty($getData[5])){{$getData[5]}} @else <span class="text-danger">Not Set</span> @endif</td>
                                            <td><input type="text" value="{{$getData[6]}}" name="previous_price[]">@if(!empty($getData[6])){{$getData[6]}} @else <span class="text-danger">Not Set</span> @endif</td>
                                            <td>@if(!empty($getData[7])){{$getData[7]}} <input type="text" value="{{$getData[7]}}" name="price[]"> @else <input type="number" placeholder="price is mandatory" name="price[]" required id=""> @endif</td>
                                            <td>@if(!empty($getData[8])){{$getData[8]}} <input type="text" value="{{$getData[8]}}" name="stock[]"> @else  <input type="text" value="0" name="stock[]"> @endif</td>
                                            <td><input type="text" value="{{$getData[9]}}" name="short_description[]">@if(!empty($getData[9])){{ substr($getData[9], 0, 20)}}... @else <span class="text-danger">Not Set</span> @endif</td>
                                            <td><input type="text" value="{{$getData[10]}}" name="description[]">@if(!empty($getData[10])){{ substr($getData[10], 0, 30)}}... @else <span class="text-danger">Not Set</span> @endif</td>
                                            <td><input type="text" value="{{$getData[11]}}" name="meta_title[]">@if(!empty($getData[11])){{ substr($getData[11], 0, 10)}}... @else <span class="text-danger">Not Set</span> @endif</td>
                                            <td><input type="text" value="{{$getData[12]}}" name="meta_data[]">@if(!empty($getData[12])){{ substr($getData[12], 0, 30)}}... @else <span class="text-danger">Not Set</span> @endif</td>
                                            <td>@if(!empty($getData[13])) <input type="text" value="{{$getData[13]}}" name="small_image[]"> <img width="50" src="{{asset($getData[13])}}"> @else <input type="text" name="" placeholder="Small image url is mandatory" required id=""> @endif</td>
                                            <td>@if(!empty($getData[14])) <input type="text" value="{{$getData[14]}}" name="lg_image_1[]"><img width="100" src="{{asset($getData[14])}}"> @else <input type="text" name="" placeholder="Large image 1 url is mandatory" required id=""> @endif</td>
                                            <td>@if(!empty($getData[15])) <input type="text" value="{{$getData[15]}}" name="lg_image_3[]"> <img width="100" src="{{asset($getData[15])}}"> @else <input type="text"  name="lg_image_2[]"><span class="text-danger">Not Set</span> @endif</td>
                                            <td>@if(!empty($getData[16])) <input type="text" value="{{$getData[16]}}" name="lg_image_2[]"> <img width="100" src="{{asset($getData[16])}}"> @else <input type="text"  name="lg_image_3[]"> <span class="text-danger">Not Set</span> @endif</td>
                                            
                                            
                                        </tr>
                                        @php
                                            $ubrand = 0;
                                            $ucat = 0;
                                            $usubCat = 0;
                                        $ss= substr(str_shuffle($getData[0]),0, 4).rand(0,3);
                                        $i++;
                                        }
                                        fclose($file);
                                        @endphp
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="text" name="count" value="{{$i}}" id="">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
