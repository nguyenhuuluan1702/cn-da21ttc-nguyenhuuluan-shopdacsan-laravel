# Hai Lúa Trà Vinh - Website Giới Thiệu và Mua Bán Đặc Sản

Website giúp người dùng tìm hiểu thông tin về đặc sản địa phương Trà Vinh và mỏa sắm trực tuyến.

## Tính Năng
- Giới thiệu các đặc sản của Trà Vinh.
- Tích hợp giỏ hàng và thanh toán trực tuyến.
- Tìm kiếm và phân loại sản phẩm.
- Quản lý tài khoản người dùng và admin.

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
- Node.js >= 14.x (nếu sử dụng Asset Compilation)

## Hướng Dẫn Cài Đặt
### 1. Clone Repository
```bash
git clone https://github.com/<your-username>/<your-repo-name>.git
cd <your-repo-name>
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
  DB_DATABASE=hai_lua_travinh
  DB_USERNAME=root
  DB_PASSWORD=
  ```

### 4. Tạo CSDL và Chạy Migration
- Tạo CSDL:
  Đảm bảo đã tạo database theo tên định nghĩa trong `.env`.
- Chạy migration:
  ```bash
  php artisan migrate --seed
  ```
  
### 5. Build Assets (Frontend)
```bash
npm run dev # Hoặc npm run build cho production
```

### 6. Khởi Chạy Dự Án
```bash
php artisan serve
```
Mở trình duyệt và truy cập [http://localhost:8000](http://localhost:8000).

## Tài Khoản Mặc Định
- Admin:
  - Email: `admin@example.com`
  - Password: `password`
- User:
  - Email: `user@example.com`
  - Password: `password`

## Nâng Cấp Framework
Nếu các bạn muốn nâng cấp lên Laravel 11 và PHP 8.1, tham khảo tài liệu chính thức từ Laravel và thực hiện các bước sau:
1. Cập nhật file `composer.json`.
2. Chạy lại các lệnh Composer.
3. Kiểm tra tính tương thích của các gói phụ thuộc.

## Liên Hệ
- **Tác Giả**: [Họ Tên Của Bạn]
- **Email**: [email@example.com]
- **Github**: [https://github.com/<your-username>](https://github.com/<your-username>)
