<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Customer;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index() {
     return view('admin_login');   
    }
    public function show_dashboard(Request $request) {
        $this->AuthLogin();

        $product_dem = Product::all()->count();
        $news_dem = News::all()->count();
        $order_dem = Order::all()->count();
        $customer_dem = Customer::all()->count();

        $products_in_stock = Product::select('product_name', 'product_quantity')->get();

        $product_views = Product::where('product_views', '>', 0)
                            ->orderBy('product_views', 'desc')
                            ->take(20)
                            ->get();

        $news_views = News::orderBy('news_views', 'DESC')->take(20)->get();

         // Dữ liệu cho sản phẩm bán chạy nhất
        $top_products = Product::orderBy('product_sold', 'desc')->take(10)->get();

        return view('admin.dashboard')->with(compact('product_dem', 'news_dem', 'order_dem', 'customer_dem','product_views','news_views','top_products', 'products_in_stock'));

    }

    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($result){
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc email không đúng');
            return Redirect::to('/admin');
        }
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
    
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
        if($data['dashboard_value'] == '7ngay'){
            $get = Statistic::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        } elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Statistic::whereBetween('order_date', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('order_date', 'ASC')->get();
        } elseif($data['dashboard_value'] == 'thangnay'){
            $get = Statistic::whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'ASC')->get();
        } else {
            $get = Statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }
    
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
    
        echo $data = json_encode($chart_data);
    }
     

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
    
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
    
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
    
        echo $data = json_encode($chart_data);
    }

    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();
    
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
    
        echo $data = json_encode($chart_data);
    }
    
    
    public function logout() {
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
