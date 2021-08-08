<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Image;

class ProductCon extends Controller
{
    
    // Add Product page
    public function add_product_page(){
        $categories = DB::table('categories')->orderBy('id', 'DESC')->get();
        $brands = DB::table('brands')->orderBy('id', 'DESC')->get();
        return view('cms.product.add_product', compact('categories', 'brands'));
        
    }

    // product category id to subcategory dependent
    public function catID_to_subCat_dependency($catID){
        $subcat = DB::table('sub_categories')->where('catID', $catID)->get();
        return response()->json($subcat);
    }
    
    // Active product index page
    public function index_active(){
        $products = DB::table('products')->where('active', 1)->orderBy('id', 'DESC')->get();
        return view('cms.product.all_active_product', compact('products'));
    }

    // Deactive product index page
    public function index_deactive(){
        $products = DB::table('products')->where('active', 0)->orderBy('id', 'DESC')->get();
        return view('cms.product.all_deactive_product', compact('products'));
    }

    // Special Discount product index page
    public function CMSspecialProduct(){
        $products = DB::table('products')->where('active', 1)->where('special_discount', 1)->get();
        return view('cms.product.all_special_product', compact('products'));
    }

    

    
    // This is the product info function
    public function ProductInfo($id){
        $product = DB::table('products')
            ->join('categories', 'products.catID', 'categories.id')
            ->join('sub_categories', 'products.subCatID', 'sub_categories.id')
            ->join('brands', 'products.brandID', 'brands.id')
            ->select('products.*', 'categories.name', 'sub_categories.sub_cat_name', 'brands.brand_name')
            ->where('products.id', $id)
            ->get();

            return view('cms.product.product_info', compact('product'));

    }

    // This is for set variations form page
    public function ProductVariation($id){
        $product = DB::table('products')->where('id', $id)->first();
        $variations = DB::table('varieations')->orderBy('id', 'DESC')->get();
        $exist_variations = DB::table('product_variations')
        ->join('varieations', 'product_variations.variation_id', 'varieations.id')
        ->select('product_variations.*', 'varieations.vari_name')
        ->where('product_unique_id', $id)
        ->get();
        return view('cms.product.product_variation', compact('product', 'variations', 'exist_variations'));
    }

    // Set Variations
    public function SetVariation(Request $request){

        if(!empty($request->variation_id)) {
            //This is for variation query
            
            $count = count($request->variation_id);
            $vari_data = array();
            
            for($i = 0; $i < $count; $i++) {

                if($request->product_variation_id[$i] == 'new'){
                    //echo $request->variation_id[$i]."New<br>";
                    $vari_data['product_unique_id'] = $request->product_unique_id;
                    $vari_data['variation_id'] = $request->variation_id[$i];
                    $vari_data['attribute_name'] = $request->attribute[$i];
                    $vari_data['price'] = $request->price[$i];
                    $vari_data['created_at'] = Carbon::now();
                    
                    DB::table('product_variations')->insert($vari_data);
                }
                else {
                    $vari_data['attribute_name'] = $request->attribute[$i];
                    $vari_data['price'] = $request->price[$i];
                    $vari_data['updated_at'] = Carbon::now();
                    DB::table('product_variations')-> where('id', $request->product_variation_id[$i])->update($vari_data);
                }
            }
            $pDATA = array();
            $pDATA['product_type'] = 'variation';
            DB::table('products')-> where('id', $request->product_unique_id)->update($pDATA);
            return Redirect()->route('all_active_product')->with('status', 'Variation Updated Successfully');
        }
        else {
            return Redirect()->back();
        }
    }

    // This is the delete Attribute Ajax
    public function DeleteAttribute($attID){
        DB::table('product_variations')->where('id', '=', $attID)->delete();
    }
    
    // Add Product Function
    public function addProduct(Request $request){
        $request->validate([
            'title' => 'required|unique:products|max:400',
            'url' => 'required|unique:products|max:400',
            'catID' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'small_image' => 'required',
            'lg_image_1' => 'required',
        ]);

        $totalProduct = DB::table('products')->count();
        $updateP = $totalProduct + 1;
        $uniCode = "p".$updateP;

        // Begin::Small Image
        $small_img = $request->file('small_image');
        $name_gen = hexdec(uniqid()).".".$small_img->getClientOriginalExtension();
        Image::make($small_img)->resize(250, 248)->save('images/product/'.$name_gen);
        $final_small_img = 'images/product/'.$name_gen;
        // End::Small Image

        // Begin::large Image 1
        $lg_img_1 = $request->file('lg_image_1');
        $name_gen = hexdec(uniqid()).".".$lg_img_1->getClientOriginalExtension();
        Image::make($lg_img_1)->resize(450, 595)->save('images/product/'.$name_gen);
        $final_lg_img_1 = 'images/product/'.$name_gen;
        // End::large Image 1

        // Begin::large Image 2
        if($request->hasFile('lg_image_2')){
            $lg_img_2 = $request->file('lg_image_2');
            $name_gen = hexdec(uniqid()).".".$lg_img_2->getClientOriginalExtension();
            Image::make($lg_img_2)->resize(450, 595)->save('images/product/'.$name_gen);
            $final_lg_img_2 = 'images/product/'.$name_gen;
        }
        else {
            $final_lg_img_2 = '';
        }
        // End::large Image 2

        // Begin::large Image 3
        if($request->hasFile('lg_image_3')){
            $lg_img_3 = $request->file('lg_image_3');
            $name_gen = hexdec(uniqid()).".".$lg_img_3->getClientOriginalExtension();
            Image::make($lg_img_3)->resize(450, 595)->save('images/product/'.$name_gen);
            $final_lg_img_3 = 'images/product/'.$name_gen;
        }
        else {
            $final_lg_img_3 = '';
        }
        // End::large Image 3

        $data = array();
        $data['unique_code'] = $uniCode;
        $data['title'] = $request->title;
        $data['url'] = $request->url;
        $data['catID'] = $request->catID;
        $data['subCatID'] = $request->subCatID;
        $data['brandID'] = $request->brandID;
        $data['stock'] = $request->stock;
        $data['sku'] = $request->sku;
        $data['special_discount'] = $request->special_discount_product;
        $data['product_type'] = 'simple';
        $data['small_image'] = $final_small_img;
        $data['lg_image_1'] = $final_lg_img_1;
        $data['lg_image_2'] = $final_lg_img_2;
        $data['lg_image_3'] = $final_lg_img_3;
        $data['previous_price'] = $request->previous_price;
        $data['price'] = $request->price;
        $data['short_description'] = $request->short_description;
        $data['description'] = $request->editor1;
        $data['meta_title'] = $request->meta_title;
        $data['meta_data'] = $request->meta_description;
        $data['active'] = 1;
        $data['created_at'] = Carbon::now();

        DB::table('products')->insert($data);
        return Redirect()->route('all_active_product')->with('status', 'Simple Product Added Successfully');
       
    }


    // Deactive Product Function
    public function deactiveProduct($id){

        $data = array();
        $data['active'] = 0;
        $data['updated_at'] = Carbon::now();
        DB::table('products')-> where('id', $id) ->update($data);
        return redirect()->back()->with('status', 'Product Deactive Successfully');

    }

    // Active Product Function
    public function ActiveProduct($id){

        $data = array();
        $data['active'] = 1;
        $data['updated_at'] = Carbon::now();
        DB::table('products')-> where('id', $id) ->update($data);
        return redirect()->back()->with('status', 'Product Active Successfully');

    }

    // Edit Product Function
    public function EditProduct($id){
        $categories = DB::table('categories')->orderBy('id', 'DESC')->get();
        $brands = DB::table('brands')->orderBy('id', 'DESC')->get();
        $Product = DB::table('products')-> where('id', $id) ->first();
        $subCats = DB::table('sub_categories')-> where('catID', $Product->catID) ->get();
        return view('cms.product.edit_product', compact('Product', 'categories', 'brands', 'subCats'));
    }

    // Update Product Function
    public function UpdateProduct(Request $request, $id){

        $request->validate([
            'title' => 'required|max:400',
            'url' => 'required|max:400',
            'catID' => 'required',
            'price' => 'required',
            'short_description' => 'max:500',
            'editor1' => 'max:900',
            'meta_title' => 'max:400',
            'editor2' => 'max:900'
            
         ]);


         $data = array();

        // Begin::Small Image
        if($request->hasFile('small_image')){
            $small_img = $request->file('small_image');
            $name_gen = hexdec(uniqid()).".".$small_img->getClientOriginalExtension();
            Image::make($small_img)->resize(250, 248)->save('images/product/'.$name_gen);
            $final_small_img = 'images/product/'.$name_gen;

            $small_image_old = $request->small_image_old;
            if(!empty($small_image_old)){
                unlink($small_image_old);
            }

            $data['small_image'] = $final_small_img;
        }
        // End::Small Image

        // Begin::large Image 1
        if($request->hasFile('lg_image_1')) {
            $lg_img_1 = $request->file('lg_image_1');
            $name_gen = hexdec(uniqid()).".".$lg_img_1->getClientOriginalExtension();
            Image::make($lg_img_1)->resize(450, 595)->save('images/product/'.$name_gen);
            $final_lg_img_1 = 'images/product/'.$name_gen;

            $lg_image_1_old = $request->lg_image_1_old;
            if(!empty($lg_image_1_old)){
                unlink($lg_image_1_old);
            }

            $data['lg_image_1'] = $final_lg_img_1;
        }
        // End::large Image 1

        // Begin::large Image 2
        if($request->hasFile('lg_image_2')){
            $lg_img_2 = $request->file('lg_image_2');
            $name_gen = hexdec(uniqid()).".".$lg_img_2->getClientOriginalExtension();
            Image::make($lg_img_2)->resize(450, 595)->save('images/product/'.$name_gen);
            $final_lg_img_2 = 'images/product/'.$name_gen;

            $lg_image_2_old = $request->lg_image_2_old;
            if(!empty($lg_image_2_old)){
                unlink($lg_image_2_old);
            }

            
            $data['lg_image_2'] = $final_lg_img_2;
        }
        // End::large Image 2

        // Begin::large Image 3
        if($request->hasFile('lg_image_3')){
            $lg_img_3 = $request->file('lg_image_3');
            $name_gen = hexdec(uniqid()).".".$lg_img_3->getClientOriginalExtension();
            Image::make($lg_img_3)->resize(450, 595)->save('images/product/'.$name_gen);
            $final_lg_img_3 = 'images/product/'.$name_gen;

            $lg_image_3_old = $request->lg_image_3_old;
            if(!empty($lg_image_3_old)){
                unlink($lg_image_3_old);
            }

            $data['lg_image_3'] = $final_lg_img_3;
        }
        // End::large Image 3

        
        $data['title'] = $request->title;
        $data['url'] = $request->url;
        $data['catID'] = $request->catID;
        $data['subCatID'] = $request->subCatID;
        $data['brandID'] = $request->brandID;
        $data['sku'] = $request->sku;
        $data['special_discount'] = $request->special_discount_product;
        $data['previous_price'] = $request->previous_price;
        $data['price'] = $request->price;
        $data['stock'] = $request->stock;
        $data['short_description'] = $request->short_description;
        $data['description'] = $request->editor1;
        $data['meta_title'] = $request->meta_title;
        $data['meta_data'] = $request->editor2;
        $data['active'] = 1;
        $data['updated_at'] = Carbon::now();

        DB::table('products')-> where('id', $id)->update($data);
        return Redirect()->route('all_active_product')->with('status', 'Product Update Successfully');

    }

    // Begin:: Product File Manager
    public function ProductFileManager() {
        return view('cms.product.file_manager');
    }
    // End:: Product File Manager

    // Begin:: Product File Manager Add new Image
    public function FileManager_Add_new_image(Request $request) {

        $request->validate([
            'smORlg' => 'required',
            'image' => 'required',
        ]);

        if($request->smORlg == 'sm') {
            // Begin::Small Image
            $small_img = $request->file('image');
            $name_gen = hexdec(uniqid()).".".$small_img->getClientOriginalExtension();
            Image::make($small_img)->resize(250, 248)->save('images/product/'.$name_gen);
            $final_small_img = 'images/product/'.$name_gen;
            // End::Small Image
            return Redirect()->back()->with('status', 'Product Small Image Added Successfully');
        }
        else if($request->smORlg == 'lg'){
            // Begin::large Image 1
            $lg_img_1 = $request->file('image');
            $name_gen = hexdec(uniqid()).".".$lg_img_1->getClientOriginalExtension();
            Image::make($lg_img_1)->resize(450, 595)->save('images/product/'.$name_gen);
            $final_lg_img_1 = 'images/product/'.$name_gen;
            // End::large Image 1
            return Redirect()->back()->with('status', 'Product Large Image Added Successfully');
        } 
        
    }
    // End:: Product File Manager Add new Image

    // Begin:: Product CSV page
    public function product_csv_page() {
        return view('cms.product.product_csv_page');
    }
    // End:: Product CSV page

    // Begin:: Product CSV page
    public function csv_to_show_product_info(Request $request) {
        $filename= $request->csvFile; 
        $file = fopen($filename, "r");
        $i = 1;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {

            $ptitle = $getData[0];
            $url = str_replace(" ","-", $ptitle);
            $urlCheck = DB::table('products')->where('url', $url)->first();

            if(empty($urlCheck->id) && !empty($getData[0]) && !empty($getData[3]) && !empty($getData[7]) && !empty($getData[13]) && !empty($getData[14])) {
                $totalProduct = DB::table('products')->count();
                $updateP = $totalProduct + 1;
                $uniCode = "p".$updateP;

                if($getData[5] == 'yes'){
                    $discountP = 1;
                }
                else {
                    $discountP = 0;
                }

                $previous_price = str_replace(",", "", $getData[6]);
                $price = str_replace(",", "", $getData[7]);

                $data = array();

                $data['unique_code'] = $uniCode;
                $data['title'] = $ptitle;
                $data['url'] = $url;
                $data['catID'] = $getData[3];
                $data['subCatID'] = $getData[4];
                $data['brandID'] = $getData[2];
                $data['stock'] = $getData[8];
                $data['sku'] = $getData[1];
                $data['special_discount'] = $discountP;
                $data['product_type'] = 'simple';
                $data['small_image'] = $getData[13];
                $data['lg_image_1'] = $getData[14];
                $data['lg_image_2'] = $getData[15];
                $data['lg_image_3'] = $getData[16];
                $data['previous_price'] = $previous_price;
                $data['price'] = $price;
                $data['short_description'] = $getData[9];
                $data['description'] = $getData[10];
                $data['meta_title'] = $getData[11];
                $data['meta_data'] = $getData[12];
                $data['active'] = 1;
                $data['created_at'] = Carbon::now();

                DB::table('products')->insert($data);
                $i++;
            }

        $ss= substr(str_shuffle($getData[0]),0, 4).rand(0,3);
        }
        fclose($file);

        if($i > 1){
            return Redirect()->route('all_active_product')->with('status', 'Product Upload Successfully.');
        }
        else {
            return Redirect()->back()->with('adminError', 'No Product Uploaded!');
        }

        

        
        //return view('cms.product.show_product_after_up_csv', compact('filename'));
    }
    // End:: Product CSV page

    // Begin:: Product CSV page
    public function csv_info_to_upload_final(Request $request) {
        $totalProduct= $request->count; 

        return $totalProduct;

        //return view('cms.product.show_product_after_up_csv', compact('filename'));
    }
    // End:: Product CSV page

    

    

    
}
