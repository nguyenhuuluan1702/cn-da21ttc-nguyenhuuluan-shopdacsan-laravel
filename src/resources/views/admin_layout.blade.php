<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Visitors an Admin Panel Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="/assets/backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="/assets/backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="/assets/backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="/assets/backend/css/font.css" type="text/css"/>
<link href="/assets/backend/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="/assets/backend/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="/assets/backend/css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="/assets/backend/js/jquery2.0.3.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/assets/backend/js/morris.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> -->
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="/assets/backend/images/2.png">
                <span class="username">
				<?php

					use Illuminate\Support\Facades\Session;

						$name = Session::get('admin_name');
						if($name){	
							echo $name;
						}
	?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
                        <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/insert-coupon')}}">Quản lý mã giảm giá</a></li>
						<li><a href="{{URL::to('/list-coupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                      
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-news')}}">Thêm danh mục bài viết</a></li>
						<li><a href="{{URL::to('/all-category-news')}}">Liệt kê danh mục bài viết</a></li>
                      
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-news')}}">Thêm bài viết</a></li>
						<li><a href="{{URL::to('/all-news')}}">Liệt kê bài viết</a></li>
                      
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                      
                    </ul>
                </li>
                
            </ul>            
		</div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="/assets/backend/js/bootstrap.js"></script>
<script src="/assets/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/assets/backend/js/scripts.js"></script>
<script src="/assets/backend/js/jquery.slimscroll.js"></script>
<script src="/assets/backend/js/jquery.nicescroll.js"></script>
<script src="/assets/backend/js/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.36/jquery.form-validator.min.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script>
        // Khởi tạo CKEditor
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
    </script>

<script type="text/javascript">
		$.validate({

		});
</script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<!-- morris JavaScript -->	

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // Lắng nghe sự kiện nhập giá vốn
        document.getElementById('product_von').addEventListener('input', function() {
            const von = parseFloat(this.value) || 0; // Lấy giá vốn
            const price = Math.round(von * 1.3); // Tính giá bán và làm tròn
            document.getElementById('product_price').value = price; // Cập nhật giá bán
        });
    });
</script>




<script type="text/javascript">
$(function() {
    $("#datepicker").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
    $("#datepicker2").datepicker({
        prevText: "Tháng trước",
        nextText: "Tháng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: [ "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật" ],
        duration: "slow"
    });
});
</script>


<script type="text/javascript">
   $(document).ready(function() {

        //chart30daysorder();

            var chart = new Morris.Bar({
            // ID của phần tử để vẽ biểu đồ.
            element: 'myfirstchart',
            // Dữ liệu biểu đồ - mỗi mục trong mảng này tương ứng với một điểm trên biểu đồ.
            // data: [
            //     {"period":"2024-11-31","order":1},
            //     {"period":"2024-12-01","order":1},
            //     {"period":"2024-12-07","order":6}
            // ],
            lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
            // pointFillColors: ['#ffffff'],
            // pointStrokeColors: ['black'],
            // fillOpacity: 0.6,
            parseTime: false,
            hideHover: 'auto',
            // Tên của thuộc tính dữ liệu chứa giá trị x.
            xkey: 'period',
            // Danh sách tên của các thuộc tính dữ liệu chứa giá trị y.
            ykeys: ['order', 'sales', 'profit', 'quantity'],
            //behaveLikeLine: true,
            // Nhãn cho các ykeys - sẽ hiển thị khi di chuột qua biểu đồ.
            labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']
        });

            //     function chart30daysorder() {
            //     var _token = $('input[name="_token"]').val();
            //     $.ajax({
            //         url: "{{url('/days-order')}}",
            //         method: "POST",
            //         dataType: "JSON",
            //         data: {_token: _token},
            //         success: function(data) {
            //             chart.setData(data);
            //         }
            //     });
            // }

            $('.dashboard-filter').change(function() {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/dashboard-filter')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {dashboard_value: dashboard_value, _token: _token},
                    success: function(data) {
                        chart.setData(data);
                }
            });
        });

    $('#btn-dashboard-filter').click(function() {
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        
        $.ajax({
            url: "{{url('/filter-by-date')}}",
            method: "POST",
            dataType: "JSON",
            data: {from_date: from_date, to_date: to_date, _token: _token},
            success: function(data) {
                chart.setData(data);
            }
        });
    });
});
</script>



<script type="text/javascript">
$(document).ready(function(){
    var donut = Morris.Donut({
        element: 'donut',
        resize: false,
        colors: [
            '#ce616a',
            '#61a1ce',
            '#cebf61',
            '#f5b942',      
            '#4842f5'
        ],
        //labelColor: "#cccccc", // text color
        //backgroundColor: '#333333', // border color
        data: [
            {label: "Sản phẩm", value: <?php echo $product_dem ?>},
            {label: "Bài viết", value: <?php echo $news_dem ?>},
            {label: "Đơn hàng", value: <?php echo $order_dem ?>},
            {label: "Khách hàng", value: <?php echo $customer_dem ?>}
        ]
    });
});
</script>


<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        // alert(order_product_id);
        // alert(order_qty);
        // alert(order_code);
        $.ajax({
                url : '{{url("/update-qty")}}',

                method: 'POST',

                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){

                    alert('Cập nhật số lượng thành công');
                 
                   location.reload();
                    
                }
        });

    });
</script>

<!-- <script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();

        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){
          
                $.ajax({
                        url : '{{url("/update-order-qty")}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                location.reload();
                            }
                });
            
        }

    });
</script> -->

<script type="text/javascript">
		$('.order_details').change(function () {
    var order_status = $(this).val();
    var order_id = $(this).children(":selected").attr("id");
    var _token = $('input[name="_token"]').val();

    // Lấy ra số lượng khách đặt
    quantity = [];
    $("input[name='product_sales_quantity']").each(function () {
        quantity.push($(this).val());
    });

    // Lấy ra product_id
    order_product_id = [];
    $("input[name='order_product_id']").each(function () {
        order_product_id.push($(this).val());
    });

    // Biến đếm lỗi
    var errorFlag = false;

    for (let i = 0; i < order_product_id.length; i++) {
        var order_qty = parseInt($('.order_qty_' + order_product_id[i]).val());
        var order_qty_storage = parseInt($('.order_qty_stronge_' + order_product_id[i]).val());

        if (order_qty > order_qty_storage) {
            alert('Số lượng mua lớn hơn số lượng trong kho');
            $('.color_qty_' + order_product_id[i]).css('background', '#f8d7da'); // Đổi màu để thông báo lỗi
            errorFlag = true;
        }
    }

    // Nếu không có lỗi thì gửi AJAX
    if (!errorFlag) {
        $.ajax({
            url: '{{url("/update-order-qty")}}',
            method: 'POST',
            data: {
                _token: _token,
                order_status: order_status,
                order_id: order_id,
                quantity: quantity,
                order_product_id: order_product_id
            },
            success: function (data) {
                alert('Thay đổi tình trạng đơn hàng thành công');
                location.reload();
            },
            error: function () {
                alert('Đã xảy ra lỗi khi cập nhật đơn hàng');
            }
        });
    }
});

</script>




<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
