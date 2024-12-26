<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Slider;
use App\Models\CateNews;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class CategoryNews extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_news() {
        $this->AuthLogin(); 
        return view('admin.category_news.add_category');
    }

    public function all_category_news() {
        $this->AuthLogin(); 
        $category_news = CateNews::orderBY('cate_news_id','DESC')->paginate(5);
    	
    	return view('admin.category_news.all_category')->with(compact('category_news'));
    }

    public function save_category_news(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
        $category_news = new CateNews();
    	$category_news->cate_news_name = $data['cate_news_name'];
    	$category_news->cate_news_slug = $data['cate_news_slug'];
    	$category_news->cate_news_desc = $data['cate_news_desc'];
    	$category_news->cate_news_status = $data['cate_news_status'];
        $category_news->save();
    	
    	Session::put('message','Thêm danh mục bài viết thành công');
    	return redirect()->back();
    }

    public function edit_category_news($category_news_id){
        $this->AuthLogin();
        $category_news = CateNews::find($category_news_id);

    	return view('admin.category_news.edit_category')->with(compact('category_news'));

        
    }

    public function update_category_news(Request $request, $cate_id){
    
        $data = $request->all();
        $category_news = CateNews::find($cate_id);
    	$category_news->cate_news_name = $data['cate_news_name'];
    	$category_news->cate_news_slug = $data['cate_news_slug'];
    	$category_news->cate_news_desc = $data['cate_news_desc'];
    	$category_news->cate_news_status = $data['cate_news_status'];
        $category_news->save();
    	
    	Session::put('message','Cập nhật danh mục bài viết thành công');
    	return redirect('/all-category-news');
    }

    public function delete_category_news($cate_id){
        $category_news = CateNews::find($cate_id);

        $category_news->delete();
        Session::put('message','Xóa danh mục bài viết thành công');
    	return redirect()->back();
    }

    public function unactive_category_news($category_news_id){
        $this->AuthLogin();
        DB::table('tbl_category_news')->where('cate_news_id',$category_news_id)->update(['cate_news_status'=>1]);
        Session::put('message','Không kích hoạt danh mục bài viết thành công');
        return Redirect::to('all-category-news');

    }
    public function active_category_news($category_news_id){
        $this->AuthLogin();
        DB::table('tbl_category_news')->where('cate_news_id',$category_news_id)->update(['cate_news_status'=>0]);
        Session::put('message','Kích hoạt danh mục bài viết thành công');
        return Redirect::to('all-category-news');
    }

    public function danh_muc_bai_viet($cate_news_slug){

    }


}
