<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\CateNews;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Models\Slider;
use GuzzleHttp\Psr7\Message;

session_start();

class CartController extends Controller
{

    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        $total = Session::get('cart') ? array_sum(array_map(function($cart) {
            return $cart['product_price'] * $cart['product_qty'];
        }, Session::get('cart'))) : 0;
    
        if ($total < 200000) {
            return redirect()->back()->with('error', 'Tổng tiền của đơn hàng phải lớn hơn 200,000 VNĐ để áp dụng mã giảm giá.');
        }
    
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
            }
        } else {
            return redirect()->back()->with('error', 'Mã giảm giá không đúng');
        }
    }
    
    public function gio_hang(Request $request){

    $category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();
        //seo 
        //slide
    $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

    //    $meta_desc = "Giỏ hàng của bạn"; 
    //    $meta_keywords = "Giỏ hàng Ajax";
    //    $meta_title = "Giỏ hàng Ajax";
    //    $url_canonical = $request->url();
       //--seo
       $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
       $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

       return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('category_news', $category_news);
   }

    public function add_cart_ajax(Request $request){
        // Session::forget('cart');
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
       
        Session::save();

    }   
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first(); 

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');
        //Cart::destroy();
    }

    public function show_cart(){

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

       
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);

    }

    public function delete_product($session_id){
        $cart = Session::get('cart');
        // echo '<pre>';
        // print_r($cart);
        // echo '</pre>';
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');

        }else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }

    }

    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }

    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa hết giỏ thành công');
        }
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id']==$key && $qty<=$cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:green">'.$i.'/. Cập nhật số lượng '.$cart[$session]['product_name'].' thành công</p>';
                    }elseif($val['session_id']==$key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color:red">'.$i.'/. Số lượng '.$cart[$session]['product_name'].' trong kho không đủ</p>';
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật số lượng thất bại');
        }
    }
}
