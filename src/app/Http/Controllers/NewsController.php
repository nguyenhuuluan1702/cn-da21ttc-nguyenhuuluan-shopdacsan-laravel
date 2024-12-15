<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\CateNews;
use App\Models\Comment;
use App\Models\News;
use App\Models\Rating;
use App\Models\Slider;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class NewsController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_news() {
        $this->AuthLogin(); 
        $cate_news = CateNews::orderBy('cate_news_id', 'DESC')->get();

        return view('admin.news.add_new')->with(compact('cate_news'));

    }
    public function all_news() {
        $this->AuthLogin();
        $all_news = News::with('cate_news')->orderBy('news_id')->paginate(10);
    	return view('admin.news.list_new')->with(compact('all_news',$all_news));
    }

    public function save_news(Request $request) {

    $this->AuthLogin();
    $data = $request->all();
    $news = new News();

    $news->news_title = $data['news_title'];
    $news->news_desc = $data['news_desc'];
    $news->news_content = $data['news_content'];
    $news->cate_news_id = $data['cate_news_id'];
    $news->news_status = $data['news_status'];

    $get_image = $request->file('news_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên của hình ảnh
            $name_image = current(explode('.', $get_name_image));

            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/news', $new_image);

            $news->news_image = $new_image;
            $news->save();

            Session::put('message', 'Thêm bài viết thành công');
            return redirect()->back();
        } else {
            Session::put('message', 'Làm ơn thêm hình ảnh');
            return redirect()->back();
        }

    }

        public function delete_news($news_id)
    {
        $this->AuthLogin();
        $news = News::find($news_id);
        $news_image = $news->news_image;

        if ($news_image) {
            $path = 'public/uploads/news/' . $news_image;
            unlink($path); // Xóa file hình ảnh khỏi thư mục
        }

        $news->delete(); // Xóa bài viết khỏi cơ sở dữ liệu

        Session::put('message', 'Xóa bài viết thành công');
        return redirect()->back();
    }

    public function edit_news($news_id){
        $cate_news = CateNews::orderBy('cate_news_id')->get();
        $news = News::find($news_id);
        return view('admin.news.edit_new')->with(compact('news', 'cate_news'));
    }

    public function update_news(Request $request, $news_id){
        $this->AuthLogin();
        $data = $request->all();
        $news = News::find($news_id);

        $news->news_title = $data['news_title'];
        $news->news_desc = $data['news_desc'];
        $news->news_content = $data['news_content'];
        $news->cate_news_id = $data['cate_news_id'];
        $news->news_status = $data['news_status'];

        $get_image = $request->file('news_image');
        if ($get_image) {
            // Xóa ảnh cũ
            $news_image_old = $news->news_image;
            $path = 'public/uploads/news/' . $news_image_old;
            unlink($path);
        
            // Cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName(); // Lấy tên của hình ảnh
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/news/', $new_image);
            $news->news_image = $new_image;
        }
        
        $news->save();
        Session::put('message', 'Cập nhật bài viết thành công');
        // return redirect()->back();
        return Redirect::to('all-news');
        
    }

    public function danh_muc_bai_viet($news_id) {
        $category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();
    
        // Slide
        $slider = Slider::orderBy('slider_id', 'DESC')
            ->where('slider_status', '1')
            ->take(4)
            ->get();
        
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();
        
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();
        
        $catenews = CateNews::where('cate_news_id', $news_id)
            ->take(1)
            ->get();
        
        $cate_news_name = ""; // Khởi tạo biến rỗng để tránh lỗi
        foreach ($catenews as $key => $cate) {
            $cate_id = $cate->cate_news_id;
            $cate_news_name = $cate->cate_news_name; // Lấy tên danh mục
        }
    
        $news = News::with('cate_news')
            ->where('news_status', 0)
            ->where('cate_news_id', $cate_id)
            ->paginate(3);
        
        return view('pages.baiviet.danhmucbaiviet')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('slider', $slider)
            ->with('news', $news)
            ->with('category_news', $category_news)
            ->with('cate_news_name', $cate_news_name); // Truyền tên danh mục
    }
    

    public function bai_viet($news_id) {
        
        $category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();

        // Slide
        $slider = Slider::orderBy('slider_id', 'DESC')
            ->where('slider_status', '1')
            ->take(4)
            ->get();
        
        $cate_product = DB::table('tbl_category_product')
            ->where('category_status', '0')
            ->orderBy('category_id', 'desc')
            ->get();
        
        $brand_product = DB::table('tbl_brand')
            ->where('brand_status', '0')
            ->orderBy('brand_id', 'desc')
            ->get();

        $news = News::with('cate_news')
        ->where('news_status', 0)
        ->where('news_id', $news_id)
        ->take(1)->get();    
        
        foreach ($news as $key => $p) {
        //     // SEO
        //     $meta_desc = $cate->cate_news_desc;
        //     $meta_keywords = $cate->cate_news_slug;
        //     $meta_title = $cate->cate_news_name;
                $cate_id = $p->cate_news_id;
                // $news_id = $p->news_title;
        //     $url_canonical = $request->url();
        //     // End SEO
        }
        
        // Lấy tiêu đề bài viết
        $news_title = $news->first()->news_title ?? 'Không tìm thấy bài viết';
        
        return view('pages.baiviet.baiviet')
            ->with('category', $cate_product)
            ->with('brand', $brand_product)
            ->with('slider', $slider)
            ->with('news', $news)
            ->with('news_title', $news_title)
            ->with('category_news', $category_news);
        
    }


}
