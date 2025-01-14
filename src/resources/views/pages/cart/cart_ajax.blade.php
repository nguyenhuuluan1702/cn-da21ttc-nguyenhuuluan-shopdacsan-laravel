@extends('layout')
@section('content')
<section id="cart_items">	
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
            @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
			<div class="table-responsive cart_info">
				<form action="{{url('/update-cart')}}" method="POST">
                    @csrf
				<table style="width: 100%;" class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Sản phẩm</td>
							<td class="description">Tên sản phẩm</td>
							<td class="description">Số lượng hàng trong kho</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @if(Session::get('cart')==true)
                            @php
								$total = 0;
							@endphp  

                       @foreach(Session::get('cart') as $key => $cart)
                            @php
								$subtotal = $cart['product_price']*$cart['product_qty'];
								$total+=$subtotal;
							@endphp     
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" /></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
                                <p>{{$cart['product_name']}}</p>

							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
                                <p style="margin-left: 64px;" >{{$cart['product_quantity']}}</p>

							</td>
							<td class="cart_price">
                            <p>{{number_format($cart['product_price'],0,',','.')}}đ</p>

                            </td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">	
                                    <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">

								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                {{number_format($subtotal,0,',','.')}}đ
									
								</p>
							</td>
							<td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        
                        @endforeach
                        <tr>
                            <td>
					            <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out">
							    <td><a class="btn btn-default check_out" href="{{url('/delete-all-product')}}">Xóa tất cả</a></td>
                            </td>

                            <td>
								@if(Session::get('coupon'))
	                          	<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
								@endif
							</td>   

							<td>
								<!-- @if(Session::get('customer'))
	                          	<a class="btn btn-default check_out" href="{{url('/checkout')}}">Đặt hàng</a>
	                          	@else 
	                          	<a class="btn btn-default check_out" href="{{url('/login-checkout')}}">Đặt hàng</a>
								@endif -->

								@php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');    
									@endphp

									@if($customer_id != NULL && $shipping_id == NULL)
										<a href="{{ URL::to('/checkout') }}" class="btn btn-default check_out"> Thanh toán</a>
									@elseif($customer_id != NULL && $shipping_id != NULL)
										<a href="{{ URL::to('/payment') }}" class="btn btn-default check_out"> Thanh toán</a>
									@else
										<a href="{{ URL::to('/login-checkout') }}" class="btn btn-default check_out"> Thanh toán</a>
									@endif

							</td>

                            <!-- <td>
                                <a class="btn btn-default check_out" href="">Thanh toán</a>
                                                                
                                <a class="btn btn-default check_out" href="">Thanh toán</a>
                            </td> -->

                            <td colspan="2">
                                <div style="margin-left:192px;font-size: 24px;color: #6abc3a;">Tổng tiền: <span>{{number_format($total,0,',','.')}}đ</span></div>
                                <!-- <li>Thuế <span></span></li>
                                <li>Phí vận chuyển <span>Free</span></li> -->
                                @if(Session::get('coupon'))		
                                <li>						
                                        @foreach(Session::get('coupon') as $key => $cou)
                                            @if($cou['coupon_condition']==1)
                                                Mã giảm : {{$cou['coupon_number']}} %
                                                <p>
                                                    @php 
                                                    $total_coupon = ($total*$cou['coupon_number'])/100;
                                                    echo '<p><li>Tổng giảm:'.number_format($total_coupon,0,',','.').'đ</li></p>';
                                                    @endphp
                                                </p>
                                                <p><li>Tổng đã giảm :{{number_format($total-$total_coupon,0,',','.')}}đ</li></p>
                                            @elseif($cou['coupon_condition']==2)
                                                Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
                                                <p>
                                                    @php 
                                                    $total_coupon = $total - $cou['coupon_number'];
                                    
                                                    @endphp
                                                </p>
                                                <p><li>Tổng đã giảm :{{number_format($total_coupon,0,',','.')}}đ</li></p>
                                            @endif
                                        @endforeach
                                    @endif
                            </td>
							</li>
                            </td>
                        </tr>
                        @else 
						<tr>
							<td colspan="5"><center>
							@php 
							echo 'Không có sản phẩm nào trong giỏ hàng';
							@endphp
							</center></td>
						</tr>
                        @endif
                    </tbody>
					</form>
                    @if(Session::get('cart'))
                    <tr>
						<!-- <td>
							<form method="POST" action="{{url('/check-coupon')}}">
								@csrf
									<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
	                          		<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">                      	
                          	</form>
                        </td> -->
					</tr>
					@endif
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection
