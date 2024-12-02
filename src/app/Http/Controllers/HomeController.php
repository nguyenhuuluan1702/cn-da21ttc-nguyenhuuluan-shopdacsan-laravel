<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Http\Requests;
use App\Models\Slider;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index() {

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(6)->get();

    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('slider',$slider);
        
    }

    public function search(Request $request){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

       //seo 
       $meta_desc = "Tìm kiếm sản phẩm"; 
       $meta_keywords = "Tìm kiếm sản phẩm";
       $meta_title = "Tìm kiếm sản phẩm";
       $url_canonical = $request->url();
       //--seo
       $keywords = $request->keywords_submit;

       $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
       $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

       $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 


       return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('slider',$slider);

   }
}
