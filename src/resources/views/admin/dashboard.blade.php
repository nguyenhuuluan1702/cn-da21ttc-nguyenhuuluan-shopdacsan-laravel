@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <style type="text/css">
        p.title_thongke {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
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

<!-- <div class="row">
  <style type="text/css">
    table.table-bordered.table-dark {
      background: #32383e;
    }
    table.table-bordered.table-dark tr th {
      color: #fff;
    }
  </style>

  <p class="title_thongke">Thống kê truy cập</p>

  <table class="table table-bordered table-dark">
    <thead>
      <tr>
        <th scope="col">Đang online</th>
        <th scope="col">Tổng tháng trước</th>
        <th scope="col">Tổng tháng này</th>
        <th scope="col">Tổng một năm</th>
        <th scope="col">Tổng truy cập</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div> -->

<div class="row">
    <div class="col-md-4 col-xs-12">
        <p style="width: 252px;" class="title_thongke">Thống kê số liệu</p>
        <div id="donut" class="donut" style="width: 250px; height: 250px;"></div>
    </div>
    <div class="col-md-4 col-xs-12">
        <h3>Bài viết xem nhiều</h3>
        <ol class="list_views">
            @foreach($news_views as $key => $news)
                <li>
                    <a target="_blank" href="{{url('/bai-viet/'.$news->news_slug)}}">{{$news->news_title}} | <span style="color: black">
                        {{$news->news_views}}</span></a>
                </li>
            @endforeach 
        </ol>
    </div>
    <div class="col-md-4 col-xs-12">
        <style type="text/css">
            ol.list_views {
                margin: 10px 0;
                color: #fff;
            }
            ol.list_views a {
                color: orange;
                font-weight: 400;
            }
        </style>
        <h3>Sản phẩm xem nhiều</h3>
            <ol class="list_views">
                @foreach($product_views as $key => $pro)
                <li>
                    <a target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}">{{$pro->product_name}} | <span style="color:black">{{$pro->product_views}}</span></a>
                </li>
                @endforeach
            </ol>
    </div>
</div>

</div>

@endsection