<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Frontend
Route::get('/', function () {
    return view('layout');
});

Route::get('/','App\Http\Controllers\HomeController@index' );
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');

//Danh mục sản phẩm
Route::get('/danh-muc-san-pham/{category_id}','App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}','App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@details_product');

//Bài viết
Route::get('/danh-muc-bai-viet/{news_slug}','App\Http\Controllers\NewsController@danh_muc_bai_viet');
Route::get('/bai-viet/{news_slug}','App\Http\Controllers\NewsController@bai_viet');


//Backend
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');    
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');    
Route::post('/filter-by-date', 'App\Http\Controllers\AdminController@filter_by_date');    
Route::post('/dashboard-filter', 'App\Http\Controllers\AdminController@dashboard_filter');    
Route::post('/days-order', 'App\Http\Controllers\AdminController@days_order');    

//Category Product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');

//Brand Product
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@active_brand_product');

//Category News
Route::get('/add-category-news', 'App\Http\Controllers\CategoryNews@add_category_news');
Route::get('/all-category-news', 'App\Http\Controllers\CategoryNews@all_category_news');
Route::get('/edit-category-news/{category_news_id}', 'App\Http\Controllers\CategoryNews@edit_category_news');
Route::get('/delete-category-news/{cate_id}', 'App\Http\Controllers\CategoryNews@delete_category_news');
Route::get('/unactive-category-news/{category_news_id}', 'App\Http\Controllers\CategoryNews@unactive_category_news');
Route::get('/active-category-news/{category_news_id}', 'App\Http\Controllers\CategoryNews@active_category_news');
Route::post('/save-category-news', 'App\Http\Controllers\CategoryNews@save_category_news');
Route::post('/update-category-news/{cate_id}', 'App\Http\Controllers\CategoryNews@update_category_news');

//News
Route::get('/add-news', 'App\Http\Controllers\NewsController@add_news');
Route::get('/all-news', 'App\Http\Controllers\NewsController@all_news');
Route::get('/delete-news/{news_id}', 'App\Http\Controllers\NewsController@delete_news');
Route::get('/edit-news/{new_id}', 'App\Http\Controllers\NewsController@edit_news');
Route::post('/save-news', 'App\Http\Controllers\NewsController@save_news');
Route::post('/update-news/{news_id}', 'App\Http\Controllers\NewsController@update_news');


//Product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
Route::post('/load-comment', 'App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment', 'App\Http\Controllers\ProductController@send_comment');
Route::post('/insert-rating', 'App\Http\Controllers\ProductController@insert_rating');

Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');

//Coupon
Route::post('/insert-coupon-code', 'App\Http\Controllers\CouponController@insert_coupon_code');
Route::post('/check-coupon', 'App\Http\Controllers\CartController@check_coupon');
Route::get('/insert-coupon', 'App\Http\Controllers\CouponController@insert_coupon');
Route::get('/list-coupon', 'App\Http\Controllers\CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}', 'App\Http\Controllers\CouponController@delete_coupon');
Route::get('/unset-coupon', 'App\Http\Controllers\CouponController@unset_coupon');

//Cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/gio-hang', 'App\Http\Controllers\CartController@gio_hang');
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');
Route::get('/del-product/{session_id}', 'App\Http\Controllers\CartController@delete_product');
Route::get('/delete-all-product', 'App\Http\Controllers\CartController@delete_all_product');
Route::post('/update-cart-quantity','App\Http\Controllers\CartController@update_cart_quantity');
Route::post('/update-cart','App\Http\Controllers\CartController@update_cart');

//Checkout
Route::get('/login-checkout','App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout','App\Http\Controllers\CheckoutController@logout_checkout');
Route::get('/del-fee','App\Http\Controllers\CheckoutController@del_fee');
Route::post('/add-customer','App\Http\Controllers\CheckoutController@add_customer');
Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');
Route::post('/login-customer','App\Http\Controllers\CheckoutController@login_customer');
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment','App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer','App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::post('/confirm-order','App\Http\Controllers\CheckoutController@confirm_order');

//Order
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');
Route::get('/print-order/{checkout_code}','App\Http\Controllers\OrderController@print_order');
Route::get('/view-order/{order_code}','App\Http\Controllers\OrderController@view_order');
Route::get('/delete-order/{order_code}','App\Http\Controllers\OrderController@order_code');
Route::post('/update-order-qty','App\Http\Controllers\OrderController@update_order_qty');
Route::post('/update-qty','App\Http\Controllers\OrderController@update_qty');

//Banner
Route::get('/manage-slider','App\Http\Controllers\SliderController@manage_slider');
Route::get('/add-slider','App\Http\Controllers\SliderController@add_slider');
Route::post('/insert-slider','App\Http\Controllers\SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','App\Http\Controllers\SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','App\Http\Controllers\SliderController@active_slide');

//Xử lí xem thêm sản phẩm
Route::post('/load-more-products', 'App\Http\Controllers\HomeController@loadMoreProducts');
