<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuAHfRg32OmUcww7on3RYdg4VA+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background: #ffffff;
            border-radius: 12px;
            border: 2px solid #007bff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            max-width: 700px;
            border-top: 5px solid #00c4ff;
        }

        .email-header {
            background: linear-gradient(135deg, #007bff, #00c4ff);
            color: #ffffff;
            text-align: center;
            border-radius: 12px 12px 0 0;
            padding: 20px;
            border-bottom: 3px solid #ffffff;
        }

        .email-header h4 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .email-header h6 {
            margin: 5px 0 0;
            font-size: 14px;
        }

        .email-content {
            padding: 20px;
            color: #333333;
        }

        .email-content h4 {
            border-bottom: 2px solid #00c4ff;
            display: inline-block;
            margin-bottom: 15px;
            font-size: 18px;
            color: #007bff;
        }

        .email-content p {
            margin-bottom: 10px;
            font-size: 14px;
            line-height: 1.6;
        }

        .email-content span {
            font-weight: bold;
        }

        .table {
            margin-top: 15px;
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            border-spacing: 0;
            width: 100%;
        }

        .table thead {
            background: #00c4ff;
            color: #ffffff;
            font-weight: bold;
        }

        .table thead th {
            border: 1px solid #dddddd;
        }

        .table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody td {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        .email-footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
            text-align: center;
        }

        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h4>ĐẶC SẢN HAI LÚA TRÀ VINH</h4>
            <h6>WEBSITE MUA BÁN ĐẶC SẢN - GIỚI THIỆU - VĂN HÓA TRÀ VINH</h6>
        </div>
        <div class="email-content">
            <p>Chào bạn <span>{{ $shipping_array['customer_name'] }}</span>,</p>
            <p>Bạn hoặc một ai đó đã đăng ký dịch vụ tại shop với thông tin như sau:</p>

            <h4>Thông tin đơn hàng</h4>
            <p>Mã đơn hàng: <span>{{ $code['order_code'] }}</span></p>
            <p>Dịch vụ: <span>Đặt hàng trực tuyến</span></p>

            <h4>Thông tin người nhận</h4>
            <p>Email: <span>{{ $shipping_array['shipping_email'] ?: 'không có' }}</span></p>
            <p>Họ và tên người gửi: <span>{{ $shipping_array['shipping_name'] ?: 'không có' }}</span></p>
            <p>Địa chỉ nhận hàng: <span>{{ $shipping_array['shipping_address'] ?: 'không có' }}</span></p>
            <p>Số điện thoại: <span>{{ $shipping_array['shipping_phone'] ?: 'không có' }}</span></p>
            <p>Ghi chú đơn hàng: <span>{{ $shipping_array['shipping_notes'] ?: 'không có' }}</span></p>
            <p>Hình thức thanh toán: <span>{{ $shipping_array['shipping_method'] == 0 ? 'Chuyển khoản ATM' : 'Tiền mặt' }}</span></p>

            <h4>Sản phẩm đã đặt</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Số lượng đặt</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart_array as $cart)
                        @php $sub_total = $cart['product_qty'] * $cart['product_price']; $total += $sub_total; @endphp
                        <tr>
                            <td>{{ $cart['product_name'] }}</td>
                            <td>{{ number_format($cart['product_price'], 0, ',', '.') }}vnd</td>
                            <td>{{ $cart['product_qty'] }}</td>
                            <td>{{ number_format($sub_total, 0, ',', '.') }}vnd</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="right"><strong>Tổng tiền thanh toán: {{ number_format($total, 0, ',', '.') }}vnd</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- <p style="color:#fff;text-align:center;font-size:15x;">Xem lịch sử đơn hàng: <a target="_blank" href="{{url('/history')}}">Lịch sử đơn hàng</a></p> -->
        <div class="email-footer">
            <p>Mọi chi tiết xin liên hệ website tại: <a href="#">Shop</a>, hoặc liên hệ qua số hotline: 19005689.</p>
            <p>Xin cảm ơn quý khách đã đặt hàng tại shop chúng tôi.</p>
        </div>
    </div>
</body>
</html>
