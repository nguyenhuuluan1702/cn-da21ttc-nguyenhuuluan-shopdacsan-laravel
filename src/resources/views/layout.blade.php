<?php
use Illuminate\Support\Facades\Session;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home | E-Shopper</title>
    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/animate.css">
    <link rel="stylesheet" href="/assets/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/main.css">
    <link rel="stylesheet" href="/assets/frontend/css/prettyPhoto.css">
    <link rel="stylesheet" href="/assets/frontend/css/price-range.css">
    <link rel="stylesheet" href="/assets/frontend/css/responsive.css">
    <link rel="stylesheet" href="/assets/frontend/css/sweetalert.css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	
	
	
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="assets/frontend/images/home/logo3.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{URL::to('/admin')}}"><i class="fa fa-user"></i> Admin</a></li>
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								<?php
                                   $customer_id = Session::get('customer_id');
                                   $shipping_id = Session::get('shipping_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                 <?php 
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                 }
                                ?>
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                
                                <?php
                            }else{
                                 ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                 <?php 
                             }
                                 ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>	
                                    <ul role="menu" class="sub-menu">
									@foreach($category_news as $key => $danhmuc)
                                        <li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmuc->cate_news_id)}}">{{$danhmuc->cate_news_name}}</a></li>                                      
                                    @endforeach
                                    </ul>
                                </li> 
								<!-- <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a> -->

								<li class="dropdown"><a href="#">Danh mục<i class="fa fa-angle-down"></i></a>	
                                    <ul role="menu" class="sub-menu">
									@foreach($category as $key => $cate)
                                        <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>                                      
                                    @endforeach
                                    </ul>
                                </li> 

								<li class="dropdown"><a href="#">Thương hiệu<i class="fa fa-angle-down"></i></a>	
                                    <ul role="menu" class="sub-menu">
									@foreach($brand as $key => $thuonghieu)
                                        <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$thuonghieu->brand_id)}}">{{$thuonghieu->brand_name}}</a></li>                                      
                                    @endforeach
                                    </ul>
                                </li> 
                                    
                                </li> 
								<li><a href="{{URL::to('gio-hang')}}">Giỏ hàng</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li>
							</ul>
						</div>

					</div>
					<div class="col-sm-4">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
                            {{csrf_field()}}
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
								<input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
							</div>
                        </form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							@php 
								$i = 0;
							@endphp
							@foreach($slider as $key => $slide)
									@php 
										$i++;
									@endphp
									<div class="item {{$i==1 ? 'active' : '' }}">
									
										<div class="col-sm-12">
											<img alt="{{$slide->slider_desc}}" src="{{asset('public/uploads/slider/'.$slide->slider_image)}}" height="100" width="100%" class="img_slider">
										
										</div>
									</div>	
                       	 	@endforeach  
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<!-- <div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian">
						@foreach($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
						@endforeach
						</div>
						</div>
					
						<div class="brands_products">
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
								@foreach($brand as $key => $brand)
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right">(50)</span>{{$brand->brand_name}}</a></li>
								@endforeach
								</ul>
							</div>
						</div>

				</div> -->
				
				<div class="col-sm-12 padding-right">
					@yield('content')
					
				</div>
				</div>
			</div>
		
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="assets/frontend/images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="assets/frontend/images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="assets/frontend/images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="assets/frontend/images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="assets/frontend/images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="/assets/frontend/js/jquery.js"></script>
<script src="/assets/frontend/js/bootstrap.min.js"></script>
<script src="/assets/frontend/js/jquery.scrollUp.min.js"></script>
<script src="/assets/frontend/js/price-range.js"></script>
<script src="/assets/frontend/js/jquery.prettyPhoto.js"></script>
<script src="/assets/frontend/js/main.js"></script>
<script src="/assets/frontend/js/sweetalert.min.js"></script>


<!-- <script type="text/javascript">
	$(document).ready(function(){
		
		load_comment();

		function load_comment(){
			var product_id = $('.comment_product_id').val();
			var _token = $('input[name="_token"]').val();	
			$.ajax({
				url:"{{url('load-comment')}}",
				method:"POST",
				data:{product_id:product_id, _token:_token},
                success:function(data){
					$('#comment_show').html(data);
				}
			})
		}
		$('.send-comment').click(function(){
			var product_id = $('.comment_product_id').val();
			var comment_name = $('.comment_name').val();
			var comment_content = $('.comment_content').val();
			var _token = $('input[name="_token"]').val();	
			$.ajax({
				url:"{{url('/send-comment')}}",
				method:"POST",
				data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
                success:function(data){
					$('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công</span>');
					load_comment();
					$('#notify_comment').fadeOut(2000);
					$('.comment_name').val('');
					$('.comment_content').val('');
				}
			});
		});

	});

</script> -->

<!-- <script>
    $(document).ready(function() {
        $('#load-more').click(function() {
            var button = $(this);
            var offset = button.data('offset'); // Lấy giá trị offset hiện tại
            var _token = $('input[name="_token"]').val(); // CSRF token Laravel

            $.ajax({
                url: '{{url("/load-more-products")}}', // Route xử lý AJAX
                method: 'POST',
                data: {offset: offset, _token: _token},
                success: function(data) {
                    if (data.length > 0) {
                        // Duyệt qua sản phẩm và thêm vào danh sách
                        $.each(data, function(index, product) {
                            $('#product-list').append(`
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <a href="/chi-tiet-san-pham/${product.product_id}">
                                                    <img src="/public/uploads/product/${product.product_image}" alt="" />
                                                    <h2>${product.product_price.toLocaleString()} VNĐ</h2>
                                                    <p>${product.product_name}</p>
                                                </a>
                                                <button class="btn btn-default add-to-cart">Thêm giỏ hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });

                        // Cập nhật offset
                        button.data('offset', offset + 6);
                    } else {
                        button.text('Không còn sản phẩm').attr('disabled', 'disabled');
                    }
                }
            });
        });
    });
</script> -->


<script type="text/javascript">
    function remove_background(product_id) {
        for (var count = 1; count <= 5; count++) {
            $('#' + product_id + '-' + count).css('color', '#ccc');
        }
    }

    // Hover chuột đánh giá sao
    $(document).on('mouseenter', '.rating', function() {
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        remove_background(product_id);
        for (var count = 1; count <= index; count++) {
            $('#' + product_id + '-' + count).css('color', '#ffcc00');
        }
    });

    // Nhả chuột không đánh giá
    $(document).on('mouseleave', '.rating', function() {
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        var rating = $(this).data('rating');
        remove_background(product_id);
        for (var count = 1; count <= rating; count++) {
            $('#' + product_id + '-' + count).css('color', '#ffcc00');
        }
    });

    // Click để đánh giá sao
    $(document).on('click', '.rating', function() {
        var index = $(this).data('index');
        var product_id = $(this).data('product_id');
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{url('insert-rating')}}",
            method: 'POST',
            data: { index: index, product_id: product_id, _token: _token },
            success: function(data) {
                if (data == 'done') {
                    swal({
                        title: "Đánh giá thành công!",
                        text: "Bạn đã đánh giá " + index + " trên 5 sao",
                        type: "success",
                        confirmButtonText: "OK"
                    });
                } else {
                    swal({
                        title: "Lỗi!",
                        text: "Có lỗi xảy ra khi gửi đánh giá. Vui lòng thử lại.",
                        type: "error",
                        confirmButtonText: "OK"
                    });
                }
            },        
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function () {
        // Gọi hàm load_comment() để tải danh sách bình luận khi trang được tải
        load_comment();

        // Hàm tải bình luận
        function load_comment() {
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('load-comment')}}",
                method: "POST",
                data: { product_id: product_id, _token: _token },
                success: function (data) {
                    $('#comment_show').html(data); // Hiển thị danh sách bình luận
                },
                error: function () {
                    $('#comment_show').html('<p class="text-danger">Không thể tải bình luận, vui lòng thử lại!</p>');
                }
            });
        }

			$('.send-comment').click(function () {
			var product_id = $('.comment_product_id').val();
			var comment_name = $('.comment_name').val();
			var comment_content = $('.comment_content').val();
			var _token = $('input[name="_token"]').val();

			// Kiểm tra dữ liệu hợp lệ
			if (comment_name.trim() === '' || comment_content.trim() === '') {
				$('#notify_comment').html('<span class="text text-danger">Vui lòng nhập đầy đủ thông tin!</span>');
				return;
			}

			$.ajax({
				url: "{{url('/send-comment')}}",
				method: "POST",
				data: {
					product_id: product_id,
					comment_name: comment_name,
					comment_content: comment_content,
					_token: _token
				},
				success: function (data) {
					// Thông báo thêm bình luận thành công
					$('#notify_comment')
						.html('<span class="text text-success">Thêm bình luận thành công!</span>')
						.fadeIn()
						.delay(2000) // Hiển thị thông báo trong 2 giây
						.fadeOut(); // Chỉ ẩn phần tử thông báo, không ảnh hưởng nút "Gửi bình luận"

					// Gọi lại load_comment để cập nhật danh sách bình luận
					load_comment();

					// Làm sạch trường nhập liệu
					$('.comment_name').val('');
					$('.comment_content').val('');

					$('.send-comment').css('visibility', 'visible'); // Hiển thị nút

				},
				error: function () {
					$('#notify_comment').html('<span class="text text-danger">Không thể gửi bình luận, vui lòng thử lại!</span>');
				}
			});
		});

    });
</script>


<script type="text/javascript">
$(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
    url: '{{ url("/confirm-order") }}',
    method: 'POST',
    data: {
        shipping_email: shipping_email,
        shipping_name: shipping_name,
        shipping_address: shipping_address,
        shipping_phone: shipping_phone,
        shipping_notes: shipping_notes,
        _token: _token,
        order_coupon: order_coupon,
        shipping_method: shipping_method
    },
    success: function() {
        swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
    }
});


                        window.setTimeout(function(){ 
                            location.reload();
                        } ,2000);

                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                      }
              
                });

               
            });
        });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            var id = $(this).data('id_product');
            // alert(id);
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
			if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
				alert('Số lượng sản phẩm trong kho chỉ còn '+cart_product_quantity);
			}else{
					$.ajax({
						url: '{{ url("/add-cart-ajax") }}',
						method: 'POST',
						data: {
							cart_product_id: cart_product_id,
							cart_product_name: cart_product_name,
							cart_product_image: cart_product_image,
							cart_product_price: cart_product_price,
							cart_product_qty: cart_product_qty,
							_token: _token,
							cart_product_quantity: cart_product_quantity
						},
						success: function() {
							swal({
									title: "Đã thêm sản phẩm vào giỏ hàng",
									text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
									showCancelButton: true,
									cancelButtonText: "Xem tiếp",
									confirmButtonClass: "btn-success",
									confirmButtonText: "Đi đến giỏ hàng",
									closeOnConfirm: false
								},
								function() {
									window.location.href = "{{ url('/gio-hang') }}";
								}
							);
						}
					});
				}
        });
    });
</script>
							

</body>
</html>