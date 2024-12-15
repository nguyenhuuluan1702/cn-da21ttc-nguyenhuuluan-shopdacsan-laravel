<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Http\Requests;
use App\Models\CateNews;
use App\Models\Slider;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index() {

        $category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc') ->paginate(8);

    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('slider',$slider)->with('category_news', $category_news);
        
    }

    public function loadMoreProducts(Request $request)
{
    $offset = $request->offset; // Vị trí bắt đầu
    $limit = 6; // Số lượng sản phẩm mỗi lần tải

    // Truy vấn để lấy sản phẩm tiếp theo
    $more_products = DB::table('tbl_product')
                        ->where('product_status', '0')
                        ->orderBy('product_id', 'desc')
                        ->offset($offset)
                        ->limit($limit)
                        ->get();

    return response()->json($more_products);
}


    public function search(Request $request){

        $category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();
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


       return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('slider',$slider)->with('category_news', $category_news);

   }
}
