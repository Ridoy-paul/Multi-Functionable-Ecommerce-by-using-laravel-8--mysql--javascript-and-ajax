<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopCon extends Controller
{
    public function index() {

        
        $products = DB::table('products')
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->paginate(12);

        

        $catgories = DB::table('categories')
        ->orderBy('serial_number', 'asc')
        ->where('active', 1)
        ->get();

        $brands = DB::table('brands')->where('active', 1)->get();
        $productFrom = '0,0';
        return view('user.pages.shop.index', compact('products', 'catgories', 'brands', 'productFrom'));
    }

    // Category wise shop view
    public function CatShop($cslug) {

        $catQ = DB::table('categories')->where('url', $cslug)->first();
        $catID = $catQ->id;

        $products = DB::table('products')
        ->where('catID', $catID)
        ->where('active', 1)
        ->orderBy('id', 'desc')
        ->paginate(12);

        $catgories = DB::table('categories')
        ->orderBy('serial_number', 'asc')
        ->where('active', 1)
        ->get();

        $brands = DB::table('brands')->where('active', 1)->get();
        $productFrom = 'c,'.$catID;
        return view('user.pages.shop.index', compact('products', 'catgories', 'brands', 'productFrom'));
    }

    //subcategory wise shop view
    public function SubCatShop($url) {

        $subcatQ = DB::table('sub_categories')->where('url', $url)->first();
        $subcatID = $subcatQ->id;

        $products = DB::table('products')
        ->where('subCatID', $subcatID)
        ->where('active', 1)
        ->orderBy('id', 'desc')
        ->paginate(12);

        $catgories = DB::table('categories')
        ->orderBy('serial_number', 'asc')
        ->where('active', 1)
        ->get();

        $brands = DB::table('brands')->where('active', 1)->get();
        $productFrom = 's,'.$subcatID;
        return view('user.pages.shop.index', compact('products', 'catgories', 'brands', 'productFrom'));
    }

    //Ajax Load More button when category, subcategory and brand none
    public function ajaxShopLoad_C_and_d_noneFun(){
        $lastID = $_GET['lastID'];
        $updatedlastID = 0;
        $output = '';

        $products = DB::table('products')
                    ->where('id', '<', $lastID)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(12)
                    ->get();

            if(!$products->isEmpty()) {
                $noMorePSts = 'yes';
               
                foreach($products as $product) {
                    $output .= '<div class="col-xl-3 col-md-4 col-6  col-grid-box">
                <div class="product-box product-box2 p-2">
                    <div id="indProduct">
                    <div class="product-imgbox" >
                        <div class="product-front">
                            <a href="/product-details/'.$product->id.'/'.$product->url.'">
                                <img src="'.asset($product->small_image).'" class="img-fluid lazyload"
                                    alt="'.$product->meta_title.'">
                            </a>
                        </div>
                        <div class="product-icon icon-inline">';
                            if($product->stock > 0) {
                                if($product->product_type == 'simple'){
                                    $output .= '<input type="hidden" name="" value="1" id="checkV_'.$product->id.'">
                                <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('.$product->id.', 1)" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                                else{
                                $output .= '<button class="tooltip-top  add-cartnoty" onclick="getproductmodal('.$product->id.')" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                            }
                            $output .= '<a href="javascript:void(0)" onclick="getproductmodal('.$product->id.')"
                                class="tooltip-top" data-tippy-content="Quick View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="tooltip-top add-cartnoty" onclick="Add_to_wishlist('.$product->id.')" data-tippy-content="Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>

                        </div>
                        <div class="new-label1">
                            <div>new</div>
                        </div>';
                        if($product->stock > 0){
                            $output .= '<div class="on-sale1 bg-success text-light">
                            on sale
                        </div>';
                        }
                        else {
                            $output .= '<div class="on-sale1 bg-danger text-light">
                            Stock Out
                        </div>';
                        }
                        $output .= '</div>
                    <div class="product-detail product-detail2">
                        <a href="/product-details/'.$product->id.'/'.$product->url.'">
                            <h3>'.$product->title.'</h3>
                        </a>
                        <h5>
                        <p class="d-none" id="pPrice'.$product->id.'">'.$product->price.'</p>
                        ৳ '.$product->price.'
                            <span>';
                            if(!empty($product->previous_price)){
                                $output .= '৳ '.$product->previous_price.'';
                            }
                            $output .= '</span>
                        </h5>
                        <div class="row">
                            
                        </div>
                        </div>
                        </div>
                    
                </div>';
                     $updatedlastID = $product->id; 
                $output .= '</div>';
                }
                
            }
            else {
                $noMorePSts = 'no';
                $output .= '
                    <div id="load_more">
                        <div class="text-center"><h2><b>Sorry, No Product Found</b></h2></div>
                    </div>
                    ';
            }

        //     echo $output;

            $res = [
                'output' => $output,
                'upLastID' => $updatedlastID,
                'noMorePSts' => $noMorePSts,

            ];
            return response()->json($res);



    }

    //Ajax Load More button when category yes subcategory and brand none
    public function ajaxShopLoad_C_yes_brand_none(){
        $lastID = $_GET['lastID'];
        $catID = $_GET['catID'];
        
        $updatedlastID = 0;
        $output = '';

        $products = DB::table('products')
                    ->where('id', '<', $lastID)
                    ->where('catID', $catID)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(12)
                    ->get();

            if(!$products->isEmpty()) {
                $noMorePSts = 'yes';
                foreach($products as $product) {
                    $output .= '<div class="col-xl-3 col-md-4 col-6  col-grid-box">
                <div class="product-box product-box2 p-2">
                    <div id="indProduct">
                    <div class="product-imgbox" >
                        <div class="product-front">
                            <a href="/product-details/'.$product->id.'/'.$product->url.'">
                                <img src="'.asset($product->small_image).'" class="img-fluid lazyload"
                                    alt="'.$product->meta_title.'">
                            </a>
                        </div>
                        <div class="product-icon icon-inline">';
                            if($product->stock > 0) {
                                if($product->product_type == 'simple'){
                                    $output .= '<input type="hidden" name="" value="1" id="checkV_'.$product->id.'">
                                <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('.$product->id.', 1)" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                                else{
                                $output .= '<button class="tooltip-top  add-cartnoty" onclick="getproductmodal('.$product->id.')" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                            }
                            $output .= '<a href="javascript:void(0)" onclick="getproductmodal('.$product->id.')"
                                class="tooltip-top" data-tippy-content="Quick View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="tooltip-top add-cartnoty" onclick="Add_to_wishlist('.$product->id.')" data-tippy-content="Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>

                        </div>
                        <div class="new-label1">
                            <div>new</div>
                        </div>';
                        if($product->stock > 0){
                            $output .= '<div class="on-sale1 bg-success text-light">
                            on sale
                        </div>';
                        }
                        else {
                            $output .= '<div class="on-sale1 bg-danger text-light">
                            Stock Out
                        </div>';
                        }
                        $output .= '</div>
                    <div class="product-detail product-detail2">
                        <a href="/product-details/'.$product->id.'/'.$product->url.'">
                            <h3>'.$product->title.'</h3>
                        </a>
                        <h5>
                        <p class="d-none" id="pPrice'.$product->id.'">'.$product->price.'</p>
                        ৳ '.$product->price.'
                            <span>';
                            if(!empty($product->previous_price)){
                                $output .= '৳ '.$product->previous_price.'';
                            }
                            $output .= '</span>
                        </h5>
                        <div class="row">
                            
                        </div>
                        </div>
                        </div>
                    
                </div>';
                     $updatedlastID = $product->id; 
                $output .= '</div>';
                }
                
            }
            else {
                $noMorePSts = 'no';
                $output .= '
                    <div>
                        <div class="text-center"><h2><b>Sorry, No Product Found</b></h2></div>
                    </div>
                    ';
            }

        //     echo $output;

            $res = [
                'output' => $output,
                'upLastID' => $updatedlastID,
                'noMorePSts' => $noMorePSts,
                

            ];
            return response()->json($res);

    }

    //Ajax Load More button when  subcategory yes and brand category none
    public function ajaxShopLoad_SubCat_yes_brand_and_cat_none(){
        $lastID = $_GET['lastID'];
        $subcatID = $_GET['subCatID'];
        
        $updatedlastID = 0;
        $output = '';

        $products = DB::table('products')
                    ->where('id', '<', $lastID)
                    ->where('subCatID', $subcatID)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(12)
                    ->get();

            if(!$products->isEmpty()) {
                $noMorePSts = 'yes';
                foreach($products as $product) {
                    $output .= '<div class="col-xl-3 col-md-4 col-6  col-grid-box">
                <div class="product-box product-box2 p-2">
                    <div id="indProduct">
                    <div class="product-imgbox" >
                        <div class="product-front">
                            <a href="/product-details/'.$product->id.'/'.$product->url.'">
                                <img src="'.asset($product->small_image).'" class="img-fluid lazyload"
                                    alt="'.$product->meta_title.'">
                            </a>
                        </div>
                        <div class="product-icon icon-inline">';
                            if($product->stock > 0) {
                                if($product->product_type == 'simple'){
                                    $output .= '<input type="hidden" name="" value="1" id="checkV_'.$product->id.'">
                                <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('.$product->id.', 1)" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                                else{
                                $output .= '<button class="tooltip-top  add-cartnoty" onclick="getproductmodal('.$product->id.')" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                            }
                            $output .= '<a href="javascript:void(0)" onclick="getproductmodal('.$product->id.')"
                                class="tooltip-top" data-tippy-content="Quick View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="tooltip-top add-cartnoty" onclick="Add_to_wishlist('.$product->id.')" data-tippy-content="Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>

                        </div>
                        <div class="new-label1">
                            <div>new</div>
                        </div>';
                        if($product->stock > 0){
                            $output .= '<div class="on-sale1 bg-success text-light">
                            on sale
                        </div>';
                        }
                        else {
                            $output .= '<div class="on-sale1 bg-danger text-light">
                            Stock Out
                        </div>';
                        }
                        $output .= '</div>
                    <div class="product-detail product-detail2">
                        <a href="/product-details/'.$product->id.'/'.$product->url.'">
                            <h3>'.$product->title.'</h3>
                        </a>
                        <h5>
                        <p class="d-none" id="pPrice'.$product->id.'">'.$product->price.'</p>
                        ৳ '.$product->price.'
                            <span>';
                            if(!empty($product->previous_price)){
                                $output .= '৳ '.$product->previous_price.'';
                            }
                            $output .= '</span>
                        </h5>
                        <div class="row">
                            
                        </div>
                        </div>
                        </div>
                    
                </div>';
                    $updatedlastID = $product->id; 
                $output .= '</div>';
                }
                
            }
            else {
                $noMorePSts = 'no';
                $output .= '
                    <div>
                        <div class="text-center"><h2><b>Sorry, No Product Found</b></h2></div>
                    </div>
                    ';
            }

        //     echo $output;

            $res = [
                'output' => $output,
                'upLastID' => $updatedlastID,
                'noMorePSts' => $noMorePSts,
                

            ];
            return response()->json($res);

    }


    //Begin:: Ajax Load More button when  brand yes and subcategory, category none
    public function ajaxShopLoad_Brand_yes_subcat_and_cat_none(){
        $lastID = $_GET['lastID'];
        $brandID = $_GET['brandID'];
        
        $updatedlastID = 0;
        $output = '';

        $products = DB::table('products')
                    ->where('id', '<', $lastID)
                    ->where('brandID', $brandID)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(12)
                    ->get();

            if(!$products->isEmpty()) {
                $noMorePSts = 'yes';
                foreach($products as $product) {
                    $output .= '<div class="col-xl-3 col-md-4 col-6  col-grid-box">
                <div class="product-box product-box2 p-2">
                    <div id="indProduct">
                    <div class="product-imgbox" >
                        <div class="product-front">
                            <a href="/product-details/'.$product->id.'/'.$product->url.'">
                                <img src="'.asset($product->small_image).'" class="img-fluid lazyload"
                                    alt="'.$product->meta_title.'">
                            </a>
                        </div>
                        <div class="product-icon icon-inline">';
                            if($product->stock > 0) {
                                if($product->product_type == 'simple'){
                                    $output .= '<input type="hidden" name="" value="1" id="checkV_'.$product->id.'">
                                <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('.$product->id.', 1)" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                                else{
                                $output .= '<button class="tooltip-top  add-cartnoty" onclick="getproductmodal('.$product->id.')" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                            }
                            $output .= '<a href="javascript:void(0)" onclick="getproductmodal('.$product->id.')"
                                class="tooltip-top" data-tippy-content="Quick View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="tooltip-top add-cartnoty" onclick="Add_to_wishlist('.$product->id.')" data-tippy-content="Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>

                        </div>
                        <div class="new-label1">
                            <div>new</div>
                        </div>';
                        if($product->stock > 0){
                            $output .= '<div class="on-sale1 bg-success text-light">
                            on sale
                        </div>';
                        }
                        else {
                            $output .= '<div class="on-sale1 bg-danger text-light">
                            Stock Out
                        </div>';
                        }
                        $output .= '</div>
                    <div class="product-detail product-detail2">
                        <a href="/product-details/'.$product->id.'/'.$product->url.'">
                            <h3>'.$product->title.'</h3>
                        </a>
                        <h5>
                        <p class="d-none" id="pPrice'.$product->id.'">'.$product->price.'</p>
                        ৳ '.$product->price.'
                            <span>';
                            if(!empty($product->previous_price)){
                                $output .= '৳ '.$product->previous_price.'';
                            }
                            $output .= '</span>
                        </h5>
                        <div class="row">
                            
                        </div>
                        </div>
                        </div>
                    
                </div>';
                    $updatedlastID = $product->id; 
                $output .= '</div>';
                }
                
            }
            else {
                $noMorePSts = 'no';
                $output .= '
                    <div>
                        <div class="text-center"><h2><b>Sorry, No Product Found</b></h2></div>
                    </div>
                    ';
            }

        //     echo $output;

            $res = [
                'output' => $output,
                'upLastID' => $updatedlastID,
                'noMorePSts' => $noMorePSts,
                

            ];
            return response()->json($res);

    }
    //End:: Ajax Load More button when  brand yes and subcategory, category none


    //Begin:: Ajax Load More button when  brand yes, cat yes subcategory none
    public function ajaxShopLoad_Brand_yes_cat_yes_subcat_none(){
        $lastID = $_GET['lastID'];
        $brandID = $_GET['brandID'];
        $catID = $_GET['csID'];
        
        $updatedlastID = 0;
        $output = '';

        $products = DB::table('products')
                    ->where('id', '<', $lastID)
                    ->where('brandID', $brandID)
                    ->where('catID', $catID)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(12)
                    ->get();

            if(!$products->isEmpty()) {
                $noMorePSts = 'yes';
                foreach($products as $product) {
                    $output .= '<div class="col-xl-3 col-md-4 col-6  col-grid-box">
                <div class="product-box product-box2 p-2">
                    <div id="indProduct">
                    <div class="product-imgbox" >
                        <div class="product-front">
                            <a href="/product-details/'.$product->id.'/'.$product->url.'">
                                <img src="'.asset($product->small_image).'" class="img-fluid lazyload"
                                    alt="'.$product->meta_title.'">
                            </a>
                        </div>
                        <div class="product-icon icon-inline">';
                            if($product->stock > 0) {
                                if($product->product_type == 'simple'){
                                    $output .= '<input type="hidden" name="" value="1" id="checkV_'.$product->id.'">
                                <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('.$product->id.', 1)" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                                else{
                                $output .= '<button class="tooltip-top  add-cartnoty" onclick="getproductmodal('.$product->id.')" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                            }
                            $output .= '<a href="javascript:void(0)" onclick="getproductmodal('.$product->id.')"
                                class="tooltip-top" data-tippy-content="Quick View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="tooltip-top add-cartnoty" onclick="Add_to_wishlist('.$product->id.')" data-tippy-content="Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>

                        </div>
                        <div class="new-label1">
                            <div>new</div>
                        </div>';
                        if($product->stock > 0){
                            $output .= '<div class="on-sale1 bg-success text-light">
                            on sale
                        </div>';
                        }
                        else {
                            $output .= '<div class="on-sale1 bg-danger text-light">
                            Stock Out
                        </div>';
                        }
                        $output .= '</div>
                    <div class="product-detail product-detail2">
                        <a href="/product-details/'.$product->id.'/'.$product->url.'">
                            <h3>'.$product->title.'</h3>
                        </a>
                        <h5>
                        <p class="d-none" id="pPrice'.$product->id.'">'.$product->price.'</p>
                        ৳ '.$product->price.'
                            <span>';
                            if(!empty($product->previous_price)){
                                $output .= '৳ '.$product->previous_price.'';
                            }
                            $output .= '</span>
                        </h5>
                        <div class="row">
                            
                        </div>
                        </div>
                        </div>
                    
                </div>';
                    $updatedlastID = $product->id; 
                $output .= '</div>';
                }
                
            }
            else {
                $noMorePSts = 'no';
                $output .= '
                    <div>
                        <div class="text-center"><h2><b>Sorry, No Product Found</b></h2></div>
                    </div>
                    ';
            }

        //     echo $output;

            $res = [
                'output' => $output,
                'upLastID' => $updatedlastID,
                'noMorePSts' => $noMorePSts,

            ];
            return response()->json($res);

    }
    //End:: Ajax Load More button when brand yes, cat yes subcategory none


    //Begin:: Ajax Load More button when  brand yes, subcat yes category none
    public function ajaxShopLoad_Brand_yes_subcat_yes_cat_none(){
        $lastID = $_GET['lastID'];
        $brandID = $_GET['brandID'];
        $subcatID = $_GET['csID'];
        
        $updatedlastID = 0;
        $output = '';

        $products = DB::table('products')
                    ->where('id', '<', $lastID)
                    ->where('brandID', $brandID)
                    ->where('subCatID', $subcatID)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(12)
                    ->get();

            if(!$products->isEmpty()) {
                $noMorePSts = 'yes';
                foreach($products as $product) {
                    $output .= '<div class="col-xl-3 col-md-4 col-6  col-grid-box">
                <div class="product-box product-box2 p-2">
                    <div id="indProduct">
                    <div class="product-imgbox" >
                        <div class="product-front">
                            <a href="/product-details/'.$product->id.'/'.$product->url.'">
                                <img src="'.asset($product->small_image).'" class="img-fluid lazyload"
                                    alt="'.$product->meta_title.'">
                            </a>
                        </div>
                        <div class="product-icon icon-inline">';
                            if($product->stock > 0) {
                                if($product->product_type == 'simple'){
                                    $output .= '<input type="hidden" name="" value="1" id="checkV_'.$product->id.'">
                                <button class="tooltip-top  add-cartnoty" onclick="add_to_cart('.$product->id.', 1)" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                                else{
                                $output .= '<button class="tooltip-top  add-cartnoty" onclick="getproductmodal('.$product->id.')" data-tippy-content="Add to cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>';
                                }
                            }
                            $output .= '<a href="javascript:void(0)" onclick="getproductmodal('.$product->id.')"
                                class="tooltip-top" data-tippy-content="Quick View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="tooltip-top add-cartnoty" onclick="Add_to_wishlist('.$product->id.')" data-tippy-content="Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>

                        </div>
                        <div class="new-label1">
                            <div>new</div>
                        </div>';
                        if($product->stock > 0){
                            $output .= '<div class="on-sale1 bg-success text-light">
                            on sale
                        </div>';
                        }
                        else {
                            $output .= '<div class="on-sale1 bg-danger text-light">
                            Stock Out
                        </div>';
                        }
                        $output .= '</div>
                    <div class="product-detail product-detail2">
                        <a href="/product-details/'.$product->id.'/'.$product->url.'">
                            <h3>'.$product->title.'</h3>
                        </a>
                        <h5>
                        <p class="d-none" id="pPrice'.$product->id.'">'.$product->price.'</p>
                        ৳ '.$product->price.'
                            <span>';
                            if(!empty($product->previous_price)){
                                $output .= '৳ '.$product->previous_price.'';
                            }
                            $output .= '</span>
                        </h5>
                        <div class="row">
                            
                        </div>
                        </div>
                        </div>
                    
                </div>';
                    $updatedlastID = $product->id; 
                $output .= '</div>';
                }
                
            }
            else {
                $noMorePSts = 'no';
                $output .= '
                    <div>
                        <div class="text-center"><h2><b>Sorry, No Product Found</b></h2></div>
                    </div>
                    ';
            }

        //     echo $output;

            $res = [
                'output' => $output,
                'upLastID' => $updatedlastID,
                'noMorePSts' => $noMorePSts,

            ];
            return response()->json($res);

    }
    //End:: Ajax Load More button when  brand yes, subcat yes category none


    

    

    

    
}
