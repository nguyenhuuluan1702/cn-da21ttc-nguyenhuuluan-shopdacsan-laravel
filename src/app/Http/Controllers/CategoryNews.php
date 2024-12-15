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
        $all_category_news = DB::table('tbl_category_news')->get();
    	$manager_category_news  = view('admin.category_news.all_category')->with('all_category_news',$all_category_news);
    	return view('admin_layout')->with('admin.category_news.all_category', $manager_category_news);
    }

    public function save_category_news(Request $request){
        $this->AuthLogin();
    	$data = $request->all();
        $category_news = new CateNews();
    	$category_news->cate_news_name = $data['cate_news_name'];
    	$category_news->cate_news_desc = $data['cate_news_desc'];
    	$category_news->cate_news_status = $data['cate_news_status'];
        $category_news->save();
    	
    	Session::put('message','Thêm danh mục bài viết thành công');
    	return redirect()->back();
    }

    public function edit_category_news($category_news_id){
        $this->AuthLogin();
        $edit_category_news = DB::table('tbl_category_news')->where('cate_news_id',$category_news_id)->get();

        $manager_category_news  = view('admin.category_news.edit_category')->with('edit_category_news',$edit_category_news);

        return view('admin_layout')->with('admin.category_news.edit_category', $manager_category_news);
    }

    public function update_category_news(Request $request,$category_news_id){
        $this->AuthLogin();
        $data = array();
        $data['cate_news_name'] = $request->category_news_name;
        $data['cate_news_desc'] = $request->category_news_desc;
        DB::table('tbl_category_news')->where('cate_news_id',$category_news_id)->update($data);
        Session::put('message','Cập nhật danh mục bài viết thành công');
        return Redirect::to('all-category-news');
    }

    public function delete_category_news($category_news_id){
        $this->AuthLogin();
        DB::table('tbl_category_news')->where('cate_news_id',$category_news_id)->delete();
        Session::put('message','Xóa danh mục bài viết thành công');
        return Redirect::to('all-category-news');
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


}
