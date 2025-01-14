@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <style type="text/css">
        p.title_thongke {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>

    <div class="row">
        <p class="title_thongke">Thống kê doanh số</p>
        <form autocomplete="off">
            @csrf
            <div class="col-md-2">
                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
            </div>
            <div class="col-md-2">
                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p>
                    Lọc theo:
                    <select class="dashboard-filter form-control">
                        <option>--Chọn--</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>
                </p>
            </div>
        </form>
        <div class="col-md-12">
            <div id="myfirstchart" class="chart" style="height: 250px;"></div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-4 text-center">
        </div>

        <div class="col-md-8 text-center">
            <select id="view-options" class="form-control" style="width: 218px; margin: 0 auto;">
                <option value="top-products">Top 10 Sản phẩm bán chạy</option>
                <option value="product-views">Sản phẩm xem nhiều</option>
                <option value="news-views">Bài viết xem nhiều</option>
                <option value="stock-list">Danh sách Tồn kho</option>
            </select>
            <br>
        </div>
    </div>

    <!-- Thống kê số liệu -->
    <div class="row">
        <div class="col-md-4 col-xs-12">
            <p style="width: 252px;" class="title_thongke">Thống kê số liệu</p>
            <div id="donut" class="donut" style="width: 250px; height: 250px;"></div>
        </div>

        <div class="col-md-8 col-xs-12">

        <!-- Top 10 Sản phẩm bán chạy -->
        <div id="top-products" class="tab-content active">
            <!-- <h3 style="text-align: center;">Top 10 Sản phẩm bán chạy nhất</h3> -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng đã bán</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($top_products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_sold }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Sản phẩm xem nhiều -->
        <div id="product-views" class="tab-content">
            <!-- <h3 style="text-align: center;">Sản phẩm xem nhiều</h3> -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Lượt xem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_views as $key => $pro)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a target="_blank" href="{{ url('/chi-tiet-san-pham/'.$pro->product_id) }}">
                                    {{ $pro->product_name }}
                                </a>
                            </td>
                            <td>{{ $pro->product_views }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bài viết xem nhiều -->
        <div id="news-views" class="tab-content">
            <!-- <h3 style="text-align: center;">Bài viết xem nhiều</h3> -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề bài viết</th>
                        <th>Lượt xem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news_views as $key => $news)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a target="_blank" href="{{ url('/bai-viet/'.$news->news_slug) }}">
                                    {{ $news->news_title }}
                                </a>
                            </td>
                            <td>{{ $news->news_views }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Danh sách tồn kho -->
        <div id="stock-list" class="tab-content">
            <!-- <h3>Danh sách Tồn kho</h3> -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng tồn kho</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products_in_stock as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
   
</div>

<script>
    // Lắng nghe sự kiện thay đổi lựa chọn trong ComboBox
    document.getElementById('view-options').addEventListener('change', function () {
        var selectedTab = this.value;
        
        // Ẩn tất cả các tab
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.remove('active'));
        
        // Hiển thị tab được chọn
        document.getElementById(selectedTab).classList.add('active');
    });
</script>

@endsection
