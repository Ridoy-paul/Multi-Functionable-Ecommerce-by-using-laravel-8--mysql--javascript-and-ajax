<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCon;
use App\Http\Controllers\CategoriesCon;
use App\Http\Controllers\ShopSettingCon;
use App\Http\Controllers\PopupModalCon;
use App\Http\Controllers\SubCategory;
use App\Http\Controllers\BrandCon;
use App\Http\Controllers\ProductCon;
use App\Http\Controllers\VarieationCon;
use App\Http\Controllers\FrontProductCon;
use App\Http\Controllers\ShippingCrgCon;
use App\Http\Controllers\PromoCodeCon;
use App\Http\Controllers\FrontCon;
use App\Http\Controllers\Sub_Shipping_AreaCon;
use App\Http\Controllers\CampaignCon;
use App\Http\Controllers\PaymentMethodCon;
use App\Http\Controllers\slider;
use App\Http\Controllers\ShopCon;
use App\Http\Controllers\PromotionBannerCon;
use App\Http\Controllers\BlogCon;
use App\Http\Controllers\InvoiceCon;


// Begin:: Frontend Route 
Route::get('/', function () {
    return view('user.pages.home');
})->name('/');

//Begin:: invoice Print in user
Route::get('/invoice/{invID}/key={randID}', [InvoiceCon::class, 'FrontendInvoice']);
//End:: invoice Print in user

//Begin:: product description
Route::get('/product-details/{id}/{url}', [FrontProductCon::class, 'ProductDetails']);
//End:: product description

//Begin:: product cart
Route::get('/cart', [FrontProductCon::class, 'CartPage'])->name('product_cart');
//End:: product cart


//Begin:: product Model View Popup
Route::any('/getProducModal',[FrontProductCon::class,"getProducModal"]);
//End:: product Model View Popup

//Begin:: product Model View Popup
Route::get('/get_leftCartSidebar',[FrontProductCon::class,"RightSideCart"]);
//End:: product Model View Popup


//Begin:: Add to Cart
Route::any('/add_to_cart',[FrontProductCon::class,"Add_to_cart"]);
//End:: Add to Cart


//Begin:: load to Cart
Route::get('/load_cart_data',[FrontProductCon::class,"cartloadbyajax"]);
//End:: load to Cart

//Begin:: Update quantity to Cart
Route::get('/update_to_cart',[FrontProductCon::class,"updatetocart"]);
//End:: Update quantity to Cart

//Begin:: Delete to Cart
Route::get('/delete_from_cart',[FrontProductCon::class,"DeleteFromCart"]);
//End:: Delete to Cart

//Begin:: Delete To side Cart
Route::get('/delete-product/{productKey}',[FrontProductCon::class,"DeleteFromSideCart"]);
//End:: Delete To side Cart



//Begin:: Test
Route::get('/test',[FrontCon::class,"Test"])->name('test.user');
//End:: Test

//Begin:: Check Coupon Code
Route::get('/checkcouponCode',[FrontCon::class,"CheckCouponCode"]);
//End:: Check Coupon Code

//Begin:: User Registration page
Route::get('/register', function() {
    return view('user.pages.account.register');
})->name('user.register.page');
//End:: User Registration page

//Begin:: Send OTP
Route::get('/sendotp',[FrontCon::class,"sendotp"]);
//End:: Send OTP


//Begin:: User Register
Route::post('/user-register',[FrontCon::class,"UserRegister"])->name('user.register');
//End:: User Register

//Begin:: User Otp page
Route::get('/user/otp/{phone}',[FrontCon::class,"OTPVpage"]);
//End:: User Otp page

//Begin:: User Verify OTP
Route::post('/user/verify-otp',[FrontCon::class,"VerifyOTP"])->name('verify.otp');
//End:: User Otp Verify OTP

//Begin:: User Login
Route::any('/user/login',[FrontCon::class,"UserLogin"])->name('user.login');
//End:: User Login

//Begin:: User Logout
Route::get('/user/logout',[FrontCon::class,"UserLogout"])->name('user.logout');
//End:: User Logout

//Begin:: User password set and reset Confirm Form input
Route::post('/user/password-reset-confirm',[FrontCon::class,"UserPassResetConfirm"])->name('user.pass_reset');
//End:: User password set and reset Confirm Form input

//Begin:: User password set and reset and otp page
Route::get('/update-password/{Uinfo}',[FrontCon::class,"UserPassResetPage"]);
//End:: User password set and reset and  otp page

//Begin:: User password update Step one: first phone number or email check
Route::get('/update-password/put-info', function() {
    return view('user.pages.account.forgot_pass');
})->name('user_update_pass_s_one');

Route::post('/update-password/step-one',[FrontCon::class,"UserPassUpdate_step_one"])->name('updatepass.step_one');
//End:: User password update Step one: first phone number or email check

//Begin:: User Search Product
Route::get('/shop/search',[FrontProductCon::class,"UserProduct_Search"])->name('user.search.product');
//End:: User Search Product












Route::group(['middleware'=>'user_auth'], function() {
    Route::get('/my-account', [FrontCon::class, 'MyAccountPage'])->name('user.myaccount');
    Route::get('/account-update', [FrontCon::class, 'UserEditAccount'])->name('user.editAccount');
    Route::post('/update-userprofile/{id}', [FrontCon::class, 'UpdateUserProfile']);
    Route::get('/all-orders', [FrontCon::class, 'UserAllOrders'])->name('user.all.orders');
    
    
    
    Route::get('/convertPtoTK', [FrontCon::class, 'ConvertPointtoTK']);
    Route::post('/user/cancelOrderByUser', [FrontCon::class, 'OrderCancelByUser'])->name('order_cancel_by_user');
    
});

//Begin:: User Checkout page
Route::any('/checkout',[FrontCon::class,"UserCheckout"])->name('user.checkout');
//End:: User Checkout page

//Begin:: User Checkout Phone Number
Route::get('/checkoutPhone',[FrontCon::class,"CheckoutPhoneNumberCheck"]);
//End:: User Checkout Phone Number

//Begin:: User Checkout Email
Route::get('/checkoutEmail',[FrontCon::class,"CheckoutEmailCheck"]);
//End:: User Checkout Email

//Begin:: Set Shipping Cookie
Route::get('/setShippingCookie',[FrontCon::class,"SetShippingCookie"]);
//End:: Set Shipping Cookie




//Begin:: User Checkout Email
Route::get('/findDistrictIDtoThana/{dID}',[FrontCon::class,"FindDistrictIDtoThanaAjax"]);
//End:: User Checkout Email

//Begin:: User Checkout Confirm Order
Route::post('/confirm-order',[FrontCon::class,"Confrim_order"])->name('confirm.order');
//End:: User Checkout Confirm Order

//Begin:: User Invoice page
Route::get('/orders/{invID}',[FrontCon::class,"UserOrders"]);
//End:: User Invoice page


//Begin:: User Checkout Confirm Order
Route::any('/track-order',[FrontCon::class,"TrackOrder"])->name('user.trackorder');
//End:: User Checkout Confirm Order

//Begin:: User Shop page
Route::any('/shop',[ShopCon::class,"index"])->name('shop');
//End:: User Shop page

//Begin:: User Shop page as category
Route::any('/shop/categories/{cslug}',[ShopCon::class,"CatShop"]);
//End:: User Shop page as category

//Begin:: User Shop page as sub-category 
Route::any('/shop/sub-category/{url}',[ShopCon::class,"SubCatShop"]);
//End:: User Shop page as sub-category

//Begin:: Ajax Load More button when category, subcategory and brand none
Route::get('/ajaxShopLoad_C_and_d_none', [ShopCon::class,"ajaxShopLoad_C_and_d_noneFun"]);
//End:: Ajax Load More button when category, subcategory and brand none

//Begin:: Ajax Load More button when category yes subcategory and brand none
Route::get('/ajaxShopLoad_C_yes_brand_none', [ShopCon::class,"ajaxShopLoad_C_yes_brand_none"]);
//End:: Ajax Load More button when category yes subcategory and brand none

//Begin:: Ajax Load More button when  subcategory yes and brand category none
Route::get('/ajaxShopLoad_SubCat_yes_brand_and_cat_none', [ShopCon::class,"ajaxShopLoad_SubCat_yes_brand_and_cat_none"]);
//End:: Ajax Load More button when  subcategory yes and brand category none

//Begin:: Ajax Load More button when  brand yes and subcategory, category none
Route::get('/ajaxShopLoad_Brand_yes_subcat_and_cat_none', [ShopCon::class,"ajaxShopLoad_Brand_yes_subcat_and_cat_none"]);
//End:: Ajax Load More button when  brand yes and subcategory, category none

//Begin:: Ajax Load More button when  brand yes, cat yes subcategory none
Route::get('/ajaxShopLoad_Brand_yes_cat_yes_subcat_none', [ShopCon::class,"ajaxShopLoad_Brand_yes_cat_yes_subcat_none"]);
//End:: Ajax Load More button when  brand yes, cat yes subcategory none

//Begin:: Ajax Load More button when  brand yes, subcat yes category none
Route::get('/ajaxShopLoad_Brand_yes_subcat_yes_cat_none', [ShopCon::class,"ajaxShopLoad_Brand_yes_subcat_yes_cat_none"]);
//End:: Ajax Load More button when  brand yes, subcat yes category none

//Begin:: User Search Product
Route::get('/shop/search',[FrontProductCon::class,"UserProduct_Search"])->name('user.search.product');
//End:: User Search Product

//Begin:: User Blog
Route::get('/blog', [BlogCon::class,"UserBlogIndex"])->name('user.blog');
Route::get('/Blog_load_more_using_ajax', [BlogCon::class,"BlogLoad_more_ajax"]);
Route::get('/blog/{id}/{url}', [BlogCon::class,"UserBlogDetails"]);

//End:: User Blog

//Begin:: Wishlist
Route::any('/add_to_wishList',[FrontProductCon::class,"Add_to_WishList"]);
Route::get('/wishlist', [FrontProductCon::class,"Wishlist_page"])->name('user.wishlist');
Route::get('/wishlist/count_wishlist_data', [FrontProductCon::class,"Count_wishlist_data"]);
Route::get('/wishlist/delete_item', [FrontProductCon::class,"Delete_wishlist_item"]);
//End:: Wishlist

//Begin:: Extra
Route::get('/about-us', [FrontCon::class,"AboutUS"])->name('user.about.us');
Route::get('/contact-us', [FrontCon::class,"contact_us"])->name('user.contact.us');
Route::get('/mission-vission', [FrontCon::class,"Mission_vission"])->name('user.mission.vission');
Route::get('/terms-and-conditions', [FrontCon::class,"Terma_and_conditions"])->name('user.terms.and.conditions');
Route::get('/privacy-policy', [FrontCon::class,"privacy_policy"])->name('user.privacy.policy');
//End:: Extra
























































// End:: Frontend Route 


// Begin:: Backend Route 

Route::group(['middleware'=>'admin_auth'], function() {
    Route::get('/cms', [AdminCon::class, 'index'])->name('/cms');
    Route::get('/cms-profile', [AdminCon::class, 'CMSProfile'])->name('cms.profile');

    

    // Begin:: Categories
    Route::get('/cms/all-category', [CategoriesCon::class, 'index'])->name('all_cat');
    Route::post('/category/add-category', [CategoriesCon::class, 'addCategory'])->name('add_category');
    Route::get('/deactiveCategory/{id}', [CategoriesCon::class, 'deactiveCategory']);
    Route::get('/activeCat/{id}', [CategoriesCon::class, 'ActiveCategory']);
    Route::get('/editCategory/{id}', [CategoriesCon::class, 'EditCategory']);
    Route::post('/update_category/{id}', [CategoriesCon::class, 'UpdateCategory']);
    // End:: Categories

    // Begin:: Sub-Categories
    Route::get('/cms/all-sub-category', [SubCategory::class, 'index'])->name('all_sub_cat');
    Route::post('/category/add-sub-category', [SubCategory::class, 'add_Sub_Category'])->name('add_sub_category');
    Route::get('/DeactiveSubCategory/{id}', [SubCategory::class, 'deactiveSubCategory']);
    Route::get('/ActiveSubCategory/{id}', [SubCategory::class, 'ActiveSubCategory']);
    Route::get('/editSubCategory/{id}', [SubCategory::class, 'EditSubCategory']);
    Route::post('/update_Subcategory/{id}', [SubCategory::class, 'UpdateSubCategory']);
    // End:: Sub-Categories

    // Begin:: Brands
    Route::get('/cms/all-brand', [BrandCon::class, 'index'])->name('all_brand');
    Route::post('/category/add-brand', [BrandCon::class, 'addBrand'])->name('add_brand');
    Route::get('/deactivebrand/{id}', [BrandCon::class, 'deactiveBrand']);
    Route::get('/activeBrand/{id}', [BrandCon::class, 'ActiveBrand']);
    Route::get('/editBrand/{id}', [BrandCon::class, 'EditBrand']);
    Route::post('/update_brand/{id}', [BrandCon::class, 'UpdateBrand']);
    // End:: Brands

    // Begin:: setting 
    Route::get('/cms/shop-setting', function() {
        return view('cms.setting.shop_setting');
    })->name('admin_setting');

    Route::post('/cms/add-shop-setting', [ShopSettingCon::class, 'addSetting'])->name('shop_setting_set');
    Route::get('cms/edit-shop-setting/{id}', [ShopSettingCon::class, 'EditShopSetting']);
    Route::post('update_shop_setting/{id}', [ShopSettingCon::class, 'UpdateShopSetting']);
    // End:: Setting
    
    // Begin:: Slider
    Route::get('/cms/all-slider', [slider::class, 'index'])->name('all_slider');
    Route::post('/cms/slider/add-slider', [slider::class, 'AddSlider'])->name('add_slider');
    Route::get('/cms/editslider/{id}', [slider::class, 'EditSlider']);
    Route::post('/cms/update_slider/{id}', [slider::class, 'UpdateSlider']);
    // End:: Slider

    // Begin:: popup Modal
    Route::get('/cms/all-popup-modal', [PopupModalCon::class, 'index'])->name('popup_modal');
    Route::post('/popup/update-popup/{id}', [PopupModalCon::class, 'updatePopup']);
    // End:: popup Modal

    // Begin:: product
    Route::get('/cms/all-active-product', [ProductCon::class, 'index_active'])->name('all_active_product');
    Route::get('/cms/all-discount-product', [ProductCon::class, 'CMSspecialProduct'])->name('specialDiscountProduct');
    Route::get('/cms/findCatIDTosubCatName/{catID}', [ProductCon::class, 'catID_to_subCat_dependency']);
    Route::get('/cms/deactive-products', [ProductCon::class, 'index_deactive'])->name('all_deactive_product');
    Route::get('/cms/product/add-product', [ProductCon::class, 'add_product_page'])->name('add_product');
    Route::post('/cms/product/add-product-con', [ProductCon::class, 'addProduct'])->name('add_product_Con');
    Route::get('/cms/product-info/{id}', [ProductCon::class, 'ProductInfo']);
    Route::get('/cms/active-product/{id}', [ProductCon::class, 'ActiveProduct']);
    Route::get('/cms/deactive-product/{id}', [ProductCon::class, 'deactiveProduct']);
    Route::get('/activeCat/{id}', [ProductCon::class, 'ActiveProduct']);
    Route::get('/cms/edit-Product/{id}', [ProductCon::class, 'EditProduct']);
    Route::post('/cms/update-product/{id}', [ProductCon::class, 'UpdateProduct']);
    Route::get('/cms/product-variation/{id}', [ProductCon::class, 'ProductVariation']);
    Route::post('/cms/set-variation', [ProductCon::class, 'SetVariation'])->name('set_variations');
    Route::post('/cms/delete_vari_attribute/{attID}', [ProductCon::class, 'DeleteAttribute']);
    Route::get('/cms/product-file-manager', [ProductCon::class, 'ProductFileManager'])->name('product_file_manager');
    Route::post('/cms/file-manager-add-image', [ProductCon::class, 'FileManager_Add_new_image'])->name('FileManager_Add_new_image');
    Route::get('/cms/product-upload-csv', [ProductCon::class, 'product_csv_page'])->name('product_csv_page');
    Route::post('/cms/product-upload-csv-info', [ProductCon::class, 'csv_to_show_product_info'])->name('csv_to_show_info');
    Route::post('/cms/product-upload-csv-final', [ProductCon::class, 'csv_info_to_upload_final'])->name('csv_info_to_upload');
    
    
    
    // End:: product

    // Begin:: Varieation
    Route::get('/cms/all-varieation', [VarieationCon::class, 'index'])->name('all_varieation');
    Route::post('/cms/category/add-varieation', [VarieationCon::class, 'AddVarieation'])->name('add_varieation');
    Route::get('/editVarieation/{id}', [VarieationCon::class, 'EditVarieation']);
    Route::post('/update_varieation/{id}', [VarieationCon::class, 'UpdateVarieation']);
    // End:: Varieation

    // Begin:: Shipping Charge
    Route::get('/cms/shipping-charge', [ShippingCrgCon::class, 'index'])->name('all_shipping_crg');
    Route::post('/cms/add-shipping-address', [ShippingCrgCon::class, 'AddShippingAddress'])->name('add_new_shipping_address');
    Route::get('/cms/editshipping/{id}', [ShippingCrgCon::class, 'EditShipping']);
    Route::post('/cms/update_shipping/{id}', [ShippingCrgCon::class, 'UpdateShipping']);
    // End:: Shipping Charge

    // Begin:: Shipping Sub Area
    Route::get('/cms/shipping-sub-area', [Sub_Shipping_AreaCon::class, 'index'])->name('shipping_sub_area');
    Route::post('/cms/add-sub-shipping-address', [Sub_Shipping_AreaCon::class, 'AddNewThana'])->name('add_new_shipping_sub_area');
    Route::get('/cms/editThana/{id}', [Sub_Shipping_AreaCon::class, 'EditThana']);
    Route::post('/cms/update_thana/{id}', [Sub_Shipping_AreaCon::class, 'UpdateThana']);
    // End:: Shipping Sub Area

    
    // Begin:: Shipping Charge
    Route::get('/cms/promo-code', [PromoCodeCon::class, 'index'])->name('all_promo_code');
    Route::post('/cms/add-promo-code', [PromoCodeCon::class, 'AddPromoCode'])->name('add_promoCode');
    Route::get('/cms/editpromoCode/{id}', [PromoCodeCon::class, 'EditPromo']);
    Route::post('/cms/update_promo_code/{id}', [PromoCodeCon::class, 'UpdatePromo']);
    // End:: Shipping Charge

    // Begin:: Wallet 
    Route::get('/cms/wallet', [CampaignCon::class, 'index'])->name('all_wallet');
    Route::post('/cms/add-wallet', [CampaignCon::class, 'AddCampaign'])->name('add_wallet');
    Route::get('/cms/edit-campaign/{id}', [CampaignCon::class, 'EditCampaignWallet']);
    Route::post('/cms/update-campaign-wallet/{id}', [CampaignCon::class, 'UpdateCampaignWallet']);
    Route::post('/cms/update-wallet-setting/{id}', [CampaignCon::class, 'UpdateWalletSetting']);
    // End:: Wallet 

    // Begin:: Payment method 
    Route::get('/cms/payment-method', [PaymentMethodCon::class, 'index'])->name('all_payment_method');
    Route::post('/cms/add-payment-method', [PaymentMethodCon::class, 'AddPayment_method'])->name('add_payment_method');
    Route::get('/cms/edit-p-method/{id}', [PaymentMethodCon::class, 'EditPMethod']);
    Route::post('/cms/update_p_method/{id}', [PaymentMethodCon::class, 'UpdatePMethod']);
    // End:: Payment method

    // Begin:: Promotion Banner
    Route::get('/cms/ads-banner', [PromotionBannerCon::class, 'index'])->name('all_promotion_banner');
    Route::post('/cms/add-ads-banner', [PromotionBannerCon::class, 'Add_ads_banner'])->name('add_ads_banner');
    Route::get('/cms/edit_ads_banner/{id}', [PromotionBannerCon::class, 'EditAdsBanner']);
    Route::post('/cms/update_ads_banner/{id}', [PromotionBannerCon::class, 'UpdateAdsBanner']);
    // End::  Promotion Banner

    // Begin:: Promotion Banner
    Route::get('/cms/ads-banner', [PromotionBannerCon::class, 'index'])->name('all_promotion_banner');
    Route::post('/cms/add-ads-banner', [PromotionBannerCon::class, 'Add_ads_banner'])->name('add_ads_banner');
    Route::get('/cms/edit_ads_banner/{id}', [PromotionBannerCon::class, 'EditAdsBanner']);
    Route::post('/cms/update_ads_banner/{id}', [PromotionBannerCon::class, 'UpdateAdsBanner']);
    // End::  Promotion Banner

    // Begin:: Orders
    Route::get('/cms/all-orders', [AdminCon::class, 'AllOrders'])->name('cms_all_order');
    Route::get('/cms/penging-orders', [AdminCon::class, 'PendingOrders'])->name('cms_pending_order');
    Route::get('/cms/processing-orders', [AdminCon::class, 'ProcessingOrders'])->name('cms_processing_order');
    Route::get('/cms/dispatched-orders', [AdminCon::class, 'DispatchedOrders'])->name('cms_dispatched_order');
    Route::get('/cms/delivered-orders', [AdminCon::class, 'DeliveredOrders'])->name('cms_delivered_order');
    Route::get('/cms/canceled-orders', [AdminCon::class, 'CanceledOrderes'])->name('cms_canceled_order');
    Route::get('/cms/orderDetails/{id}', [AdminCon::class, 'OrderDetails']);
    Route::post('/cms/admin_order_change', [AdminCon::class, 'AdminOrderStatusChange'])->name('cms.admin_order_change');
    // End::  Orders


    // Begin:: All Customers
    Route::get('/cms/all-customers', [AdminCon::class, 'Admin_all_customers'])->name('cms.all_customers');
    // End:: All Customers


    // Begin:: Promotion Banner
    Route::get('/cms/all-blog', [BlogCon::class, 'index'])->name('all_blog');
    Route::get('/cms/add-blog', function() {
        return view('cms.blog.add_blog');
    })->name('cms.add_blog_page');
    
    Route::post('/cms/add-ads-banner', [BlogCon::class, 'Add_new_blog'])->name('cms.add_blog');
    Route::get('/cms/edit-blog/{id}', [BlogCon::class, 'EditBlog']);
    Route::post('/cms/update-blog/{id}', [BlogCon::class, 'Update_Blog']);
    // End::  Promotion Banner

    

    

    
    

    
    
    
    
});




Route::get('/cms/login', function () {
    return view('cms.auth.login');
})->name('/cms/login');

Route::get('/cms/register', function () {
    return view('cms.auth.cms_register');
})->name('/cms/register');

Route::post('admin.login', [AdminCon::class, 'login'])->name('admin.login');
Route::post('admin.register', [AdminCon::class, 'adminRegister'])->name('admin.register');
Route::get('/admin_logout', [AdminCon::class, 'admin_logout'])->name('admin_logout');





// End:: Backend Route 


