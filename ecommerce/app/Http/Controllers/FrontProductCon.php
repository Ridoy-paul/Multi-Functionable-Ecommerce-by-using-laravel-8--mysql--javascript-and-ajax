<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Whoops\Run;

class FrontProductCon extends Controller
{
    // Product Details
    public function ProductDetails($id, $url) {

        $product = DB::table('products')->where('id', $id)->first();
        $exist_variations = DB::table('product_variations')
        ->join('varieations', 'product_variations.variation_id', 'varieations.id')
        ->select('product_variations.*', 'varieations.vari_name')
        ->where('product_unique_id', $id)
        ->groupBy('variation_id')
        ->get();

        //$exist_variations = DB::select("SELECT * FROM `product_variations` WHERE product_unique_id='id' GROUP BY variation_id");
        return view('user.pages.product.product_details', compact('product', 'exist_variations'));
    }

    // product popup modal
    public function getProducModal(){
        $product_id = $_GET['proid'];
        
        $product = DB::table('products')->where('id', $product_id)->first();
        $exist_variations = DB::table('product_variations')
        ->join('varieations', 'product_variations.variation_id', 'varieations.id')
        ->select('product_variations.*', 'varieations.vari_name')
        ->where('product_unique_id', $product_id)
        ->groupBy('variation_id')
        ->get();

        //$product = $product[0];
        $html = view('user.modal_view',compact('product', 'exist_variations'))->render();
        echo $html;
        
    }

    // Right side cart
    public function RightSideCart() {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        if(!empty($cart_data)) {
            $html = view('user.sideCart', compact('cart_data'))->render();
            echo $html;
        }
        else {
            $html = '<div class="text-center">
                <img style="width: 230px;" src="'.asset('frontend/img/empty_cart.png').'" alt="">
            </div>';
            echo $html;
        }
        
    }

    // Begin::Add to Cart Function
    public function Add_to_cart(){
        $pid = $_GET['proid'];
        $secID = $_GET['secID'];
        $price = $_GET['price'];
        $Qty = $_GET['qty'];
        $pType = $_GET['type'];
        
        $variations = json_decode(stripslashes($_GET['variations']));
        $product = DB::table('products')->where('id', $pid)->first();
    
        if(!empty($product->id)){

            if(Cookie::get('shopping_cart')) {

                $cookie_data = stripslashes(Cookie::get('shopping_cart'));
                $cart_data = json_decode($cookie_data, true);
            }
            else {
                $cart_data = array();
            }

            $item_id_list = array_column($cart_data, 'secPID');
            $prod_id_is_there = $secID;

            if(in_array($prod_id_is_there, $item_id_list)){

                foreach($cart_data as $keys => $values){

                    if($cart_data[$keys]["item_id"] == $pid && $cart_data[$keys]["secPID"] == $secID){
                        $preQ = $cart_data[$keys]["item_quantity"];
                        $upQ = $Qty + $cart_data[$keys]["item_quantity"]+0;
                        $cart_data[$keys]["item_quantity"] = $upQ;
                        $item_data = json_encode($cart_data);
                        $minutes = 2592000;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status'=>'Cart Updated']);
                    }
                }
            }
            else{
               
                $item_array = array(
                    'item_id' => $pid,
                    'secPID' => $secID,
                    'item_name' => $product->title,
                    'item_quantity' => $Qty,
                    'item_price' => $price,
                    'pType' => $pType,
                    
                );

                if($pType == 'variation') {
                    $i = 0;
                    foreach ($variations as $variation) {
                        $attID = $variation;
                        //$item_array += ['atID'.$i => $attID];
                        $attQ = DB::table('product_variations')
                                ->join('varieations', 'product_variations.variation_id', 'varieations.id')
                                ->select('product_variations.*', 'varieations.vari_name')
                                ->where('product_variations.id', $attID)
                                ->first();
                        if(!empty($attQ->id)){
                            $item_array += ['atID'.$i => $attID];
                            $item_array += ['atN'.$i => $attQ->vari_name];
                            $item_array += ['atV'.$i => $attQ->attribute_name];
                        }
                        else {
                            
                        }
                        
                        $i += 1;
                    }

                }

                $cart_data[] = $item_array;
                $item_data = json_encode($cart_data);
                $minutes = 2592000;
                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                return response()->json(['status'=>'Added to Cart']);
            
            }
             
        }
      
    }
    // End::Add to Cart Function

    // load total number of cart
    public function cartloadbyajax() {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data)+0;

            $res = [
                'totalcartcount' => $totalcart,
            ];
            return response()->json($res);
        
    }
    // End:: Total Cart Count item


    // load data into cart page
    public function CartPage() {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        return view('user.pages.cart.cart', compact('cart_data'));
    }

    // Update to cart by increase or decrease quantity in cart page
    public function updatetocart() {

        $secPID = $_GET['secPID'];
        $quantity = $_GET['qty'];

        if(Cookie::get('shopping_cart')) {

            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'secPID');
            $prod_id_is_there = $secPID;

            if(in_array($prod_id_is_there, $item_id_list)){ 

                foreach($cart_data as $keys => $values) {

                    if($cart_data[$keys]["secPID"] == $secPID) {

                        $cart_data[$keys]["item_quantity"] =  $quantity;
                        $item_data = json_encode($cart_data);
                        $minutes = 2592000;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        $grndTotal = $cart_data[$keys]["item_quantity"]*$cart_data[$keys]["item_price"];
                        $res = [
                            'status' => 'Quantity Updated',
                            'grandtotal' => $grndTotal,

                        ];
                        return response()->json($res);
                    }
                }
            }
        }
    }


    // Delete From Cart
    public function DeleteFromCart() {
        $secPID = $_GET['secPID'];

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'secPID');
        $prod_id_is_there = $secPID;

        if(in_array($prod_id_is_there, $item_id_list)){

            foreach($cart_data as $keys => $values){

                if($cart_data[$keys]["secPID"] == $secPID) {

                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 2592000;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    $res = [
                        'status' => 'Deleted From Cart',
                        'deleteSts' => 1,
                    ];
                    return response()->json($res);
                }
            }
        }
    }

    //Begin:: Product Delete From Side Cart
    public function DeleteFromSideCart($productKey) {
        $secPID = $productKey;

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'secPID');
        $prod_id_is_there = $secPID;

        if(in_array($prod_id_is_there, $item_id_list)){

            foreach($cart_data as $keys => $values){

                if($cart_data[$keys]["secPID"] == $secPID) {

                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 2592000;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                    return redirect()->back()->with('notAllow', 'Deleted From Cart');
                }
            }
        }
    }
    //End:: Product Delete From Side Cart


    // Begin::Add to Wishlist Function
    public function Add_to_WishList(){
        $pid = $_GET['proid'];
        $price = $_GET['price'];
        
        $product = DB::table('products')->where('id', $pid)->first();
    
        if(!empty($product->id)){

            if(Cookie::get('wishlist_items')) {

                $cookie_data = stripslashes(Cookie::get('wishlist_items'));
                $wishlist_data = json_decode($cookie_data, true);
            }
            else {
                $wishlist_data = array();
            }

            $item_id_list = array_column($wishlist_data, 'item_id');
            $prod_id_is_there = $pid;

            if(in_array($prod_id_is_there, $item_id_list)){

                // Item already exist in wishlist
                $statusData = [
                    'status' => 'Product is already exist!',
                    'YN' => 0,
                ];
                return response()->json($statusData);
            }
            else{
               
                $item_array = array(
                    'item_id' => $pid,
                    'item_name' => $product->title,
                    'item_price' => $price,
                    
                );

                $wishlist_data[] = $item_array;
                $item_data = json_encode($wishlist_data);
                $minutes = 2592000;
                Cookie::queue(Cookie::make('wishlist_items', $item_data, $minutes));
                $statusData = [
                    'status' => 'Added ot Wishlist',
                    'YN' => 1,
                ];
                return response()->json($statusData);
            
            }
             
        }
      
    }
    // End::Add to Wishlist Function

    //Begin::wishlist page
    public function Wishlist_page() {
        $cookie_data = stripslashes(Cookie::get('wishlist_items'));
        $wishlist_data = json_decode($cookie_data, true);
        return view('user.pages.wishlist.wishlist', compact('wishlist_data'));
    }
    //End::wishlist page

    //Begin:: Count Wishlist Data
    public function Count_wishlist_data() {
        $cookie_data = stripslashes(Cookie::get('wishlist_items'));
            $wishlist_data = json_decode($cookie_data, true);
            $totalwishlist_items = count($wishlist_data)+0;

            $res = [
                'totalWcount' => $totalwishlist_items,
            ];
            return response()->json($res);

    }
    //End:: Count Wishlist Data

    //Begin::Delete Wishlist item
    public function Delete_wishlist_item() {
        $pid = $_GET['pid'];

        $cookie_data = stripslashes(Cookie::get('wishlist_items'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $pid;

        if(in_array($prod_id_is_there, $item_id_list)){

            foreach($cart_data as $keys => $values){

                if($cart_data[$keys]["item_id"] == $pid) {

                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 2592000;
                    Cookie::queue(Cookie::make('wishlist_items', $item_data, $minutes));
                    $res = [
                        'status' => 'Deleted From Wishlist',
                        'deleteSts' => 1,
                    ];
                    return response()->json($res);
                }
            }
        }
    }
    //End::Delete Wishlist item

    // Begin:: User Product Search
    public function UserProduct_Search(Request $request) {
        
        $pname = $_GET['pname'];
        $products = DB::table('products')
                    ->where('title', 'like', "%{$pname}%")
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->get();

        

        $catgories = DB::table('categories')
        ->orderBy('serial_number', 'asc')
        ->where('active', 1)
        ->get();

        $brands = DB::table('brands')->where('active', 1)->get();
        $productFrom = '0,0';
        return view('user.pages.shop.index', compact('products', 'catgories', 'brands', 'productFrom'));
    }
    //End:: User Product Search

    

    





















}
