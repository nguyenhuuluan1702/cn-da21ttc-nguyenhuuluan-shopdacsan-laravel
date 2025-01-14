<?php

namespace App\Http\Controllers;

use App\Models\CateNews;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Slider;
use App\Models\Statistic;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{

	public function update_qty(Request $request){
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}

	public function update_order_qty(Request $request) {
		$data = $request->all();
		
		// Tìm kiếm đơn hàng
		$order = Order::find($data['order_id']);
		if (!$order) {
			return response()->json(['status' => 'error', 'message' => 'Đơn hàng không tồn tại']);
		}
	
		// Cập nhật trạng thái đơn hàng
		$order->order_status = $data['order_status'];
		$order->save();
	
		// Lấy ngày đặt hàng
		$order_date = $order->order_date;
	
		// Tìm kiếm dữ liệu thống kê theo ngày đặt hàng
		$statistic = Statistic::where('order_date', $order_date)->first();
	
		// Khởi tạo các giá trị ban đầu
		$total_order = 0;
		$sales = 0;
		$profit = 0;
		$quantity = 0;
	
		if ($order->order_status == 2) { // Nếu trạng thái đơn hàng là "Đã xử lý"
			foreach ($data['order_product_id'] as $key => $product_id) {
				$product = Product::find($product_id);
				if ($product) {
					$product_quantity = $product->product_quantity;
					$product_sold = $product->product_sold;
					$product_price = $product->product_price;
					$product_von = $product->product_von;
	
					// Cập nhật số lượng sản phẩm và số lượng đã bán
					foreach ($data['quantity'] as $key2 => $qty) {
						if ($key == $key2) {
							if ($qty > $product_quantity) {
								return response()->json(['status' => 'error', 'message' => 'Số lượng mua vượt quá số lượng trong kho']);
							}
	
							$pro_remain = $product_quantity - $qty;
							$product->product_quantity = $pro_remain;
							$product->product_sold = $product_sold + $qty;
							$product->save();
	
							// Cập nhật thống kê
							$quantity += $qty;
							$total_order += 1;
							$sales += $product_price * $qty;
							$profit += ($product_price - $product_von) * $qty; 
	
						}
					}
				}
			}
	
			// Cập nhật thông tin thống kê
			if ($statistic) {
				$statistic->sales += $sales;
				$statistic->profit += $profit;
				$statistic->quantity += $quantity;
				$statistic->total_order += $total_order;
				$statistic->save();
			} else {
				// Nếu không có thống kê cho ngày này, tạo mới
				$statistic_new = new Statistic();
				$statistic_new->order_date = $order_date;
				$statistic_new->sales = $sales;
				$statistic_new->profit = $profit;
				$statistic_new->quantity = $quantity;
				$statistic_new->total_order = $total_order;
				$statistic_new->save();
			}
		}
	
		return response()->json(['status' => 'success', 'message' => 'Cập nhật đơn hàng thành công']);
	}
	
	

// 	public function update_order_qty(Request $request){
// 		$data = $request->all();
// 		$order = Order::find($data['order_id']);
// 		$order->order_status = $data['order_status'];
// 		$order->save();
// 		// Lấy ngày đặt hàng
// 		$order_date = $order->order_date;

// 		// Tìm kiếm dữ liệu thống kê theo ngày đặt hàng
// 		$statistic = Statistic::where('order_date', $order_date)->get();

// 		if($statistic) {
// 			$statistic_count = $statistic->count();
// 		} else {
// 			$statistic_count = 0;
// 		}
// 		if ($order->order_status == 2) {
// 			$total_order = 0;
// 			$sales = 0;
// 			$profit = 0;
// 			$quantity = 0;
// 			foreach ($data['order_product_id'] as $key => $product_id) {
// 				$product = Product::find($product_id);
// 				$product_quantity = $product->product_quantity;
// 				$product_sold = $product->product_sold;

// 				$product_price = $product->product_price;
// 				$now = Carbon::now('Asis/Ho_Chi_Minh')->toDateString();

// 				foreach($data['quantity'] as $key2 => $qty){
// 					if($key==$key2){
// 						$pro_remain = $product_quantity - $qty;
// 						$product->product_quantity = $pro_remain;
// 						$product->product_sold = $product_sold + $qty;
// 						$product->save();

// 						$quantity += $qty; 
// 						$total_order += 1; 
// 						$sales += $product_price * $qty; 
// 						$profit = $sales - 1000;
// 						}
// 					}
// 				}
// 				if($statistic_count > 0){
// 					$statistic_update = Statistic::where('order_date', $order_date)->first();
// 					$statistic_update->sales = $statistic_update->sales + $sales;
// 					$statistic_update->profit = $statistic_update->profit + $profit;
// 					$statistic_update->quantity = $statistic_update->quantity + $quantity;
// 					$statistic_update->total_order = $statistic_update->total_order + $total_order;
// 					$statistic_update->save();
// 				}else{
// 					$statistic_new = new Statistic();
// 					$statistic_new->order_date = $order_date;
// 					$statistic_new->sales = $sales;
// 					$statistic_new->profit = $profit;
// 					$statistic_new->quantity = $quantity;
// 					$statistic_new->total_order = $total_order;
// 					$statistic_new->save();
// 				}
				
// 			}   
// }


	public function order_code(Request $request ,$order_code){
		$order = Order::where('order_code',$order_code)->first();
		$order->delete();
		 Session::put('message','Xóa đơn hàng thành công');
        return redirect()->back();

	}

	public function print_order($checkout_code) {
        // Tạo file PDF từ nội dung HTML
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
		$order_details = OrderDetails::where('order_code',$checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}

				$output = ''; 
				$output .= '
					<style>
						body { 
							font-family: DejaVu Sans, Arial, sans-serif; 
							line-height: 1.6; 
							margin: 20px; 
						} 
						.header, .footer { 
							text-align: center; 
							margin-bottom: 20px; 
						} 
						.header h1 { 
							font-size: 24px; 
							margin: 0; 
						} 
						.header h4 { 
							font-size: 16px; 
							margin: 5px 0; 
						} 
						.header p { 
							font-size: 14px; 
							margin: 5px 0; 
							font-style: italic; 
						}
						.table-styling { 
							border-collapse: collapse; 
							width: 100%; 
							margin-bottom: 20px; 
							font-size: 14px; 
						} 
						.table-styling th, .table-styling td { 
							border: 1px solid #ddd; 
							padding: 10px; 
							text-align: left; 
						} 
						.table-styling th { 
							background-color: #f4f4f4; 
							text-align: center; 
							font-weight: bold; 
						} 
						.table-styling tbody tr:nth-child(even) { 
							background-color: #f9f9f9; 
						} 
						.total { 
							text-align: right; 
							font-weight: bold; 
							font-size: 16px; 
						} 
						.sign-section { 
							margin-top: 40px; 
							display: flex; 
							justify-content: space-between; 
							align-items: flex-start; 
						} 
						.sign-section .sign-box { 
							text-align: right; 
							margin-right: 40px; 
						} 

						.sign-section .sign-box2 { 
							text-align: left; 
							margin-left: 40px; 
						} 

						.sign-section .sign-box p { 
							margin: 5px 0; 
							font-style: italic; 
						}
					</style>';

					$output .= '
					<div class="header">
						<h1>Công ty TNHH một thành viên ABCD</h1>
						<h4>Độc lập - Tự do - Hạnh phúc</h4>
						<p>Hóa đơn thanh toán</p>
					</div>';

				
				$output .= '
				<p><strong>Người đặt hàng:</strong></p>
				<table class="table-styling">
					<thead>
						<tr>
							<th>Tên khách đặt</th>
							<th>Số điện thoại</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>' . $customer->customer_name . '</td>
							<td>' . $customer->customer_phone . '</td>
							<td>' . $customer->customer_email . '</td>
						</tr>
					</tbody>
				</table>';
				
				$output .= '
				<p><strong>Ship hàng tới:</strong></p>
				<table class="table-styling">
					<thead>
						<tr>
							<th>Tên người nhận</th>
							<th>Địa chỉ</th>
							<th>Số điện thoại</th>
							<th>Email</th>
							<th>Ghi chú</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>' . $shipping->shipping_name . '</td>
							<td>' . $shipping->shipping_address . '</td>
							<td>' . $shipping->shipping_phone . '</td>
							<td>' . $shipping->shipping_email . '</td>
							<td>' . $shipping->shipping_notes . '</td>
						</tr>
					</tbody>
				</table>';
				
				$output .= '
				<p><strong>Đơn hàng đặt:</strong></p>
				<table class="table-styling">
					<thead>
						<tr>
							<th>Tên sản phẩm</th>
							<th>Mã giảm giá</th>
							<th>Số lượng</th>
							<th>Giá sản phẩm</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>';
				$total = 0;
				foreach ($order_details_product as $key => $product) {
					$subtotal = $product->product_price * $product->product_sales_quantity;
					$total += $subtotal;
					$product_coupon = ($product->product_coupon != 'no') ? $product->product_coupon : 'không mã';
					$output .= '
						<tr>
							<td>' . $product->product_name . '</td>
							<td>' . $product_coupon . '</td>
							<td>' . $product->product_sales_quantity . '</td>
							<td>' . number_format($product->product_price, 0, ',', '.') . 'đ</td>
							<td>' . number_format($subtotal, 0, ',', '.') . 'đ</td>
						</tr>';
				}
				if ($coupon_condition == 1) {
					$total_after_coupon = ($total * $coupon_number) / 100;
					$total_coupon = $total - $total_after_coupon;
				} else {
					$total_coupon = $total - $coupon_number;
				}
				$output .= '
						<tr>
							<td colspan="4" class="total">Tổng giảm:</td>
							<td>' . $coupon_echo . '</td>
						</tr>
						<tr>
							<td colspan="4" class="total">Thanh toán:</td>
							<td>' . number_format($total_coupon + $product->product_feeship, 0, ',', '.') . 'đ</td>
						</tr>
					</tbody>
				</table>';
				
										$output .= '
						<!-- Nội dung hóa đơn khác -->

						<div class="sign-section">
							<div class="sign-box">
								<strong>Người lập phiếu</strong>
							</div>

							<div class="sign-box2">
								<strong>Người nhận</strong>
							</div>

						</div>';
										
				return $output;		

	}

    public function manage_order(){
    	$order = Order::orderby('created_at','DESC')->get();
    	return view('admin.manage_order')->with(compact('order'));
    }

    public function view_order($order_code){
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','coupon_condition','coupon_number','order','order_status'));

	}

	public function history(Request $request){
		if(!Session::get('customer_id')){
			return redirect('/login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử mua hàng');
		}else{

		$category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
		$getorder = Order::where('customer_id', Session::get('customer_id'))
                 ->where('order_status', 2)
                 ->orderby('order_id', 'DESC')
                 ->get();


    	return view('pages.history.history')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('slider',$slider)->with('category_news', $category_news)->with('getorder',$getorder);
		}
	}

	public function view_history_order(Request $request, $order_code){
		if(!Session::get('customer_id')){
			return redirect('/login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử mua hàng');
		}else{

		$category_news = CateNews::orderBy('cate_news_id', 'DESC')->get();

        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

		//xem lịch sử đơn hàng
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
		$getorder = Order::where('order_code',$order_code)->first();

			$customer_id = $getorder->customer_id;
			$shipping_id = $getorder->shipping_id;
			$order_status = $getorder->order_status;

		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}

    	return view('pages.history.view_history_order')->with('category',$cate_product)->with('brand',$brand_product)
        ->with('slider',$slider)->with('category_news', $category_news)->with('order_details', $order_details)
		->with('customer', $customer)->with('shipping', $shipping)->with('coupon_condition', $coupon_condition)
		->with('coupon_number', $coupon_number)->with('getorder', $getorder)->with('order_status', $order_status)->with('order_details_product', $order_details_product);
		}
	}
	
}
