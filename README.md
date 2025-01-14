#  Xây Dựng Website Giới Thiệu và Mua Bán Đặc Sản Hai Lúa Trà Vinh

Website giúp người dùng tìm hiểu thông tin về đặc sản địa phương Trà Vinh và mua sắm trực tuyến.

## Tính Năng
- Admin:
  - Quản lý thông tin khách hàng.
  - Quản lý sản phẩm, danh mục, thương hiệu, khuyến mãi, bài viết.
  - Quản lý đơn hàng, duyệt đơn hàng.
  - Quản lý slide website.
  - Thống kê doanh số, lợi nhuận theo từng thời điểm.
  - Quản lý sản phẩm tồn kho, sản phẩm bán chạy.
- User:
  - Giới thiệu các đặc sản của Trà Vinh.
  - Tích hợp giỏ hàng và thanh toán trực tuyến qua ví VNPAY.
  - Tìm kiếm sản phẩm theo danh mục và thương hiệu.
  - Quản lý tài khoản người dùng và admin.
  - Nhận mail xác nhận đơn hàng và xem lịch sử đơn hàng.
  - Đánh giá sản phẩm sau khi mua.

## Công Nghệ Sử Dụng
- **Framework**: Laravel 8.75
- **Ngôn ngữ**: PHP 8.0
- **CSDL**: MySQL
- **Frontend**: Blade Template, Bootstrap
- **Công cụ**: Composer, NPM

## Yêu Cầu Hệ Thống
- PHP >= 8.0
- Composer >= 2.0
- MySQL >= 5.7
  
## Hướng Dẫn Cài Đặt
### 1. Clone Repository
```bash
git clone https://github.com/nguyenhuuluan1702/cn-da21ttc-nguyenhuuluan-shopdacsan-laravel.git
cd cn-da21ttc-nguyenhuuluan-shopdacsan-laravel
```

### 2. Cài Đặt Phụ Thuộc
```bash
composer install
npm install # Nếu sử dụng Laravel Mix hoặc Vite
```

### 3. Cấu Hình Môi Trường
- Tạo file `.env` bằng cách sao chép file mẫu:
  ```bash
  cp .env.example .env
  ```
- Cập nhật thông tin trong file `.env`:
  ```env
  APP_NAME=HaiLuaTraVinh
  APP_URL=http://localhost
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=database
  DB_USERNAME=root
  DB_PASSWORD=
  ```

### 4. Tạo CSDL và Chạy Migration
- Tạo CSDL:
  Tạo database theo tên định nghĩa trong `.env`.
- Chạy migration:
  ```bash
  php artisan migrate --seed
  ```

### 5. Khởi Chạy Dự Án
```bash
php artisan serve
```
Mở trình duyệt và truy cập [http://localhost:8000](http://localhost:8000).

## Tài Khoản Mặc Định
- Admin:
  - Email: `admin@gmail.com`
  - Password: `123`
- User:
  - Email: `luan@gmail.com`
  - Password: `123`

## Nâng Cấp Framework
Nếu các bạn muốn nâng cấp lên Laravel 11 và PHP 8.1, tham khảo tài liệu chính thức từ Laravel và thực hiện các bước sau:
1. Cập nhật file `composer.json`.
2. Chạy lại các lệnh Composer.
3. Kiểm tra tính tương thích của các gói phụ thuộc.

## Liên Hệ
- **Tác Giả**: Nguyễn Hữu Luân
- **Email**: nguyenhuuluantvtc@gmail.com
- **Github**: [https://github.com/nguyenhuuluan1702](https://github.com/nguyenhuuluan1702)
