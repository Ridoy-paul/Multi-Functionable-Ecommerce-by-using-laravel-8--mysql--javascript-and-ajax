@extends('cms.cms_master')
@section('admin_content')
<section class="section">
    <div class="section-header">
        <h1>Add New Product</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('add_product_Con') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputEmail4"><span class="text-danger">*</span>Product Title</label>
                                <input type="text" class="form-control" id="category_name" required name="title"
                                    placeholder="">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><span class="text-danger">*</span>Url</label>
                                <input type="text" name="url" class="form-control" required id="category_url">
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><span class="text-danger">*</span>Product Code/Sku</label>
                                <input type="text" name="sku" class="form-control" id="" required>
                                @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress">Brand</label>
                                <select class="form-control" name="brandID">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2"><span class="text-danger">*</span>Category</label>
                                <select class="form-control" name="catID" id="catID" required>
                                    <option>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('catID')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputAddress2">Sub Category</label>
                                <select class="form-control" name="subCatID" id="subCat">
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputCity"><span class="text-danger">*</span>Is Special Discount Product</label>
                                <select class="form-control" name="special_discount_product" required id="">
                                    <option value="">-- Select --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Previous Price</label>
                                <input type="number" class="form-control" name="previous_price" id="" step=any>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity"><span class="text-danger">*</span>Price</label>
                                <input type="number" class="form-control" required name="price" id="" step=any>
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity"><span class="text-danger">*</span>Stock</label>
                                <input type="number" class="form-control" required name="stock" id="" step=any>
                                @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Short Description</b></label>
                            <textarea name="short_description" class="form-control" rows="3" cols="50"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputState"><b>Description</b></label>
                            <textarea name="editor1"></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6"
                                style="border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div style="padding: 10px;">
                                    <div class="form-group">
                                        <label for="inputState"><b>Meta Title</b></label>
                                        <input type="text" class="form-control" id="" name="meta_title" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState"><b>Meta Description</b></label>
                                        <textarea name="meta_description" class="form-control" rows="4"
                                            cols="12"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-1">

                            </div>
                            <div class="form-group col-md-5"
                                style="border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <div style="padding: 10px;">
                                    <div class="form-group">
                                        <label for="inputState"><b><span class="text-danger">*</span>Small Image (250 X
                                                248)</b></label>
                                        <input type="file" class="form-control" id="" required name="small_image">
                                        @error('small_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState"><b><span class="text-danger">*</span>Large Image 1 (450
                                                X 595)</b></label>
                                        <input type="file" class="form-control" id="" required name="lg_image_1">
                                        @error('lg_image_1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState"><b>Large Image 2 (450 X 595)</b></label>
                                        <input type="file" class="form-control" id="" name="lg_image_2">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState"><b>Large Image 3 (450 X 595)</b></label>
                                        <input type="file" class="form-control" id="" name="lg_image_3">
                                    </div>
                                </div>
                            </div>

                            
                        </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="form-control btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>

    </div>
</section>
@endsection
