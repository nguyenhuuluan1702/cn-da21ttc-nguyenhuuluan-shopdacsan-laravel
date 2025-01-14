<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\CateNews;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Slider;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class ProductController extends Controller
{

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function top_products()
{
    $top_products = Product::orderBy('product_sold', 'desc') // Sắp xếp theo số lượng bán
        ->take(10) // Lấy 10 sản phẩm đầu tiên
        ->get(); // Lấy dữ liệu
    
    return view('admin.top_products')->with('top_products', $top_products);
}


    public function send_comment(Request $request) {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->save();

    }

    public function load_comment(Request $request) {
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->get();
        $output = '';
        foreach($comment as $key => $comm){
        $output .= '
            <div class="row style_comment">
										<div class="col-md-2">								
											<img width="100%" src="'.url('public/uploads/icon/kh3.png').'" 
                                            class="img img-responsive img thumbnail2">
										</div>

										<div class="col-md-10">
											<p>@'.$comm->comment_name.'</p>
											<p>'.$comm->comment_date.'</p>										
                                            <p>'.$comm->comment.'</p>
										</div>
									</div><p></p>
        ';

        }
        echo $output;
    }

    public function add_product() {
        $this->AuthLogin(); 
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    }
    public function all_product() {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
    	$manager_product  = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
    
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = $request->product_sold;
        $data['product_von'] = $request->product_von;
        $data['product_price'] = $request->product_von * 1.3; // Giá bán = Giá vốn + 30%
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
    
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }
    
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }
    

	public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

	public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = $request->product_sold;
        $data['product_von'] = $request->product_von;
        $data['product_price'] = $request->product_von * 1.3; // Giá bán = Giá vốn + 30%
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
    
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        }
    
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //End function Admin

    public function details_product($product_id){

        $category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }

        $product = Product::where('product_id',$product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);

        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product_details',$details_product)->with('relate',$related_product)->with('slider',$slider)->with('rating',$rating)->with('category_news', $category_news);
    }

    public function danh_gia_san_pham($product_id){

        $category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }

        $product = Product::where('product_id',$product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);

        return view('pages.sanpham.danhgiasanpham')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('product_details',$details_product)->with('relate',$related_product)->with('slider',$slider)->with('rating',$rating)->with('category_news', $category_news);
    }

    public function insert_rating(Request $request) {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
    
}   
