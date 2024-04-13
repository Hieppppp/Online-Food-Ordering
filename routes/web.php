<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogDetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FrontEndController;
use App\http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HistoryPuscherController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\StripeController;
use League\CommonMark\Parser\Block\BlockContinue;
use PHPUnit\Framework\Attributes\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('BackEnd.admin.home');
});

Route::get('/home',[FrontEndController::class,'index'])->name('home');
Route::get('/category/show_product/show/',[FrontEndController::class,'show_product'])->name('show_product');
Route::get('/contact/show/',[FrontEndController::class,'contact'])->name('contact');
Route::get('/category/product/show/{category_id}',[FrontEndController::class,'show'])->name('category_product');

// =============================== Cart =========================//
Route::get('/add/cart/{product_id}',[CartController::class,'addCart'])->name('add_to_cart');
Route::get('/cart/show',[CartController::class,'show'])->name('cart_show');
Route::get('/cart/remove/{id}',[CartController::class,'remove'])->name('remove_cart');
Route::post('/cart/update/{id}',[CartController::class,'update'])->name('update_cart');
// ================================ Cart End ===================//

// ================================ Check Out ============================ //
Route::get('/checkout/payment',[CheckOutController::class,'payment'])->name('checkout_payment');
Route::post('/checkout/new/order',[CheckOutController::class,'order'])->name('new_order');
Route::get('/checkout/order/complete',[CheckOutController::class,'complete'])->name('order_complete');


Route::get('/stripe-payment',[StripeController::class,'handleGet']);
Route::post('/stripe-payment',[StripeController::class,'handlePost'])->name('stripe.payment');

// ================================ Check Out End ======================== //

// ================================= Login =============================== //
Route::get( '/register/customer',[CustomerController::class,'show'])->name('sign_up');
Route::post( '/register/customer/store',[CustomerController::class,'store'])->name('store_customer');

Route::get( '/login/customer',[CustomerController::class,'login'])->name('login_in');
Route::post( '/logout/customer',[CustomerController::class,'logout'])->name('log_out');
Route::post( '/checkout/customer/login',[CustomerController::class,'check'])->name('check_login');

Route::get('/verify-email/{token}', [CustomerController::class,'verifyCustomer'])->name('customer.verify');



Route::get('/shipping',[CustomerController::class,'shipping']);
Route::post('/shipping/store',[CustomerController::class,'save'])->name('store_shipping');
Route::get('/customer/profile',[CustomerController::class,'profile'])->name('customer_profile');
Route::post('/customer/profile/update', [CustomerController::class, 'updateProfile'])->name('update_profile');


Route::get('/customer/purchase',[HistoryPuscherController::class,'purchase'])->name('customer_purchase');


// ================================= Login End =========================== //



// Route::get('/home',[HomeController::class,'index'])->name('home');

// Category
Route::prefix('category')->group(function (){

    Route::get('/add', [categoryController::class, 'index'])->name('show_cate_table');
    Route::post('/save', [categoryController::class, 'save'])->name('cate_save');
    Route::get('/manage', [categoryController::class, 'manage'])->name('manage_cate');
    Route::get('/active/{category_id}', [categoryController::class, 'active'])->name('category_active');
    Route::get('/inactive/{category_id}', [categoryController::class, 'inactive'])->name('inactive_cate');
    Route::get('/delete/{category_id}', [categoryController::class, 'delete'])->name('cate_delete');
    Route::post('/update', [categoryController::class, 'update'])->name('cate_update');
});

// Delivery
Route::prefix('delivery')->group(function (){

    Route::get('/add', [DeliveryController::class,'index'])->name('show_delivery_table');
    Route::post('/save', [DeliveryController::class, 'save'])->name('delivery_save');
    Route::get('/manage', [DeliveryController::class,'manage'])->name('manage_delivery');
    Route::get('/active/{delivery_id}', [DeliveryController::class,'active'])->name('delevery_active');
    Route::get('/inactive/{delivery_id}', [DeliveryController::class,'inactive'])->name('inactive_delivery');
    Route::get('/delete/{delivery_id}', [DeliveryController::class,'delete'])->name('delivery_delete');
    Route::post('/update', [DeliveryController::class,'update'])->name('delivery_update');
});

//Coupon
Route::prefix('coupon')->group(function (){

    Route::get('/add', [CouponController::class,'index'])->name('show_coupon_table');
    Route::post('/save', [CouponController::class,'save'])->name('coupon_save');
    Route::get('/manage', [CouponController::class,'manage'])->name('manage_coupon');
    Route::get('/active/{coupon_id}', [CouponController::class,'active'])->name('coupon_active');
    Route::get('/inactive/{coupon_id}', [CouponController::class,'inactive'])->name('inactive_coupon');
    Route::get('/delete/{coupon_id}', [CouponController::class,'delete'])->name('coupon_delete');
    Route::post('/update', [CouponController::class,'update'])->name('coupon_update');
});

// Product
Route::prefix('product')->group(function (){
    Route::get('/add', [ProductController::class,'index'])->name('show_product_table');
    Route::post('/save', [ProductController::class,'save'])->name('product_save');
    Route::get('/manage', [ProductController::class,'manage'])->name('manage_product');
    Route::get('/active/{product_id}', [ProductController::class,'active'])->name('product_active');
    Route::get('/inactive/{product_id}', [ProductController::class,'inactive'])->name('inactive_product');
    Route::get('/delete/{product_id}', [ProductController::class,'delete'])->name('product_delete');
    Route::post('/update', [ProductController::class,'update'])->name('product_update');

});

// Order
Route::prefix('order')->group(function (){

    Route::get('/manage', [OrderController::class,'manageOrder'])->name('manage_order');
    Route::get('/view/detail/{order_id}', [OrderController::class,'viewOrder'])->name('view_order');
    Route::get('/view/invoice/{order_id}', [OrderController::class,'viewInvoice'])->name('view_order_invoice');
    Route::get('/download/invoice/{order_id}', [OrderController::class,'downloadInvoice'])->name('download_order_invoice');
    Route::get('/delete/{order_id}', [OrderController::class,'deleteOrder'])->name('delete_order');
    Route::get('/active/{order_id}', [OrderController::class,'active'])->name('order_active');
    Route::get('/inactive/{order_id}', [OrderController::class,'inactive'])->name('inactive_order');
});


Route::prefix('blog')->group(function(){

    Route::get('/add',[BlogController::class,'index'])->name('show_blog_table');
    Route::post('/save', [BlogController::class, 'save'])->name('blog_save');
    Route::get('/manage', [BlogController::class, 'manage'])->name('manage_blog');
    Route::get('/active/{blog_id}', [BlogController::class, 'active'])->name('blog_active');
    Route::get('/inactive/{blog_id}', [BlogController::class, 'inactive'])->name('inactive_blog');
    Route::get('/delete/{blog_id}', [BlogController::class, 'delete'])->name('blog_delete');
    Route::post('/update', [BlogController::class, 'update'])->name('blog_update');
});

Route::prefix('blogdetail')->group(function(){
    Route::get('/add', [BlogDetailController::class,'index'])->name('show_blogdetail_table');
    Route::post('/save', [BlogDetailController::class,'save'])->name('blogdetail_save');
    Route::get('/manage', [BlogDetailController::class,'manage'])->name('manage_blogdetail');
    Route::get('/active/{blogdetail_id}', [BlogDetailController::class,'active'])->name('blogdetail_active');
    Route::get('/inactive/{blogdetail_id}', [BlogDetailController::class,'inactive'])->name('inactive_blogdetail');
    Route::get('/delete/{blogdetail_id}', [BlogDetailController::class,'delete'])->name('blogdetail_delete');
    Route::post('/update', [BlogDetailController::class,'update'])->name('blogdetail_update');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


