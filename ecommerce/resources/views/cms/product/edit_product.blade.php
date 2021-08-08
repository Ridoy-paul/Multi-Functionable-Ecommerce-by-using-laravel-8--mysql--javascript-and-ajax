@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Update Product</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/cms/update-product/'.$Product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputEmail4"><span class="text-danger">*</span>Product Title</label>
                                <input type="text" class="form-control" id="category_name" value="{{ $Product->title }}"
                                    required name="title" placeholder="">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><span class="text-danger">*</span>Url</label>
                                <input type="text" name="url" value="{{ $Product->url }}" class="form-control" required
                                    id="category_url">
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><span class="text-danger">*</span>Product Code/Sku</label>
                                <input type="text" name="sku" value="{{ $Product->sku }}" required class="form-control" id="">
                                @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress">Brand</label>
                                <select class="form-control" name="brandID">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option @if($brand->id == $Product->brandID) selected @endif
                                        value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2"><span class="text-danger">*</span>Category</label>
                                <select class="form-control" name="catID" id="catID" required>
                                    <option>Select Category</option>
                                    @foreach($categories as $category)
                                    <option @if($category->id == $Product->catID) selected @endif
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('catID')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Sub Category</label>
                                <select class="form-control" name="subCatID" id="subCat">
                                    <option value="">Select Sub Category</option>
                                    @foreach($subCats as $subCat)
                                    <option @if($subCat->id == $Product->subCatID) selected @endif
                                        value="{{ $subCat->id }}">{{ $subCat->sub_cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCity">Is Special Discount Product</label>
                                <select class="form-control" name="special_discount_product" required id="">
                                    <option value="">-- Select --</option>
                                    <option @if($Product->special_discount == 1) selected @endif value="1">Yes</option>
                                    <option @if($Product->special_discount != 1) selected @endif value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Previous Price</label>
                                <input type="number" value="{{ $Product->previous_price }}" class="form-control"
                                    name="previous_price" id="" step=any>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity"><span class="text-danger">*</span>Price</label>
                                <input type="number" value="{{ $Product->price }}" class="form-control" required
                                    name="price" id="" step=any>
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity"><span class="text-danger">*</span>Stock</label>
                                <input type="number" class="form-control" value="{{ $Product->stock }}" required name="stock" id="" step=any>
                                @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Short Description</b></label>
                            <textarea name="short_description"
                                class="form-control" rows="3" cols="50">{{ $Product->short_description }}</textarea>
                                @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Description</b></label>
                            <textarea name="editor1">{{ $Product->description }}</textarea>
                            @error('editor1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6"
                                style="border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div style="padding: 10px;">
                                    <div class="form-group">
                                        <label for="inputState"><b>Meta Title</b></label>
                                        <input type="text" value="{{ $Product->meta_title }}" class="form-control" id=""
                                            name="meta_title" placeholder="">
                                            @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState"><b>Meta Description</b></label>
                                        <textarea name="editor2">{{ $Product->meta_data }}</textarea>
                                        @error('editor2')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6"
                                style="border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div style="padding: 10px;">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState"><b><span class="text-danger">*</span>Small Image
                                                    (250 X 248)</b></label>
                                                    <input type="file" class="form-control" id="" name="small_image">
                                                    <input type="hidden" value="{{ $Product->small_image }}" name="small_image_old">
                                            @error('small_image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <img src="{{ asset($Product->small_image) }}" 
                                                width="50%">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState"><b><span class="text-danger">*</span>Large Image 1
                                                    (450 X 595)</b></label>
                                            <input type="file" class="form-control" id="" name="lg_image_1">
                                            <input type="hidden" value="{{ $Product->lg_image_1 }}" name="lg_image_1_old">
                                            @error('lg_image_1')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <img src="{{ asset($Product->lg_image_1) }}" 
                                                width="30%">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState"><b>Large Image 2 (450 X 595)</b></label>
                                            <input type="file" class="form-control" id="" name="lg_image_2">
                                            <input type="hidden" value="{{ $Product->lg_image_2 }}" name="lg_image_2_old">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <img src="{{ asset($Product->lg_image_2) }}" 
                                                width="30%">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState"><b>Large Image 3 (450 X 595)</b></label>
                                            <input type="file" class="form-control" id="" name="lg_image_3">
                                            <input type="hidden" value="{{ $Product->lg_image_3 }}" name="lg_image_3_old">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <img src="{{ asset($Product->lg_image_3) }}" 
                                                width="30%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="form-control btn btn-primary">Update</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</section>
@endsection
