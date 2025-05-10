# 🚗 Car Rental Web Application (PHP MVC)

Đây là dự án **Web Cho Thuê Xe** được xây dựng bằng ngôn ngữ PHP theo mô hình MVC (Model - View - Controller), hỗ trợ triển khai với Docker và cấu hình tích hợp thanh toán VNPay.

## 🧩 Tính năng chính

- ✅ Đặt xe trực tuyến
- ✅ Quản lý xe, người dùng, đơn thuê (admin)
- ✅ Giao diện người dùng thân thiện
- ✅ Thanh toán VNPay
- ✅ Hệ thống phân quyền cơ bản
- ✅ Triển khai bằng Docker (PHP + Apache + MySQL)

## 🗂️ Cấu trúc thư mục
```
├── config/ # Cấu hình hệ thống
│   └── vnpay_config.php # Cấu hình VNPay
├── docker/ # Cấu hình Docker
│   ├── .env # Biến môi trường cho Docker
│   ├── composer.json # Cấu hình Composer
│   ├── docker-compose.yml # File cấu hình Docker Compose
│   ├── Dockerfile # Dockerfile PHP/Apache
│   └── php.ini # Cấu hình PHP
├── mvc/ # Mã nguồn chính theo mô hình MVC
│   ├── controllers/ # Controller xử lý logic
│   ├── models/ # Model truy cập cơ sở dữ liệu
│   ├── views/ # Giao diện người dùng
│   ├── core/ # Core: Router, DB, BaseController
│   └── Bridge.php # Cầu nối hệ thống hoặc cấu hình bổ sung
├── public/ # Thư mục public (ảnh, css, js,...)
├── SQL/ # File SQL khởi tạo CSDL
│   └── car-rental-db.sql
├── vendor/ # Thư viện bên thứ ba (Composer)
├── .env # Biến môi trường ứng dụng
├── .htaccess # Rewrite URL cho Apache
├── composer.json # Quản lý gói Composer
├── composer.lock # Khoá phiên bản Composer
├── config.php # File cấu hình chung
├── index.php # Điểm vào chính của ứng dụng
├── test.php # File test (nếu có)
└── README.md # Tài liệu hướng dẫn
```

## 🐳 Khởi chạy bằng Docker

### 1. Clone dự án

```bash
git clone https://github.com/HuynhQuocTien/Car-Rental-Website.git
cd Car-Rental-Website


docker-compose up -d --build
```

docker-compose run composer require vlucas/phpdotenv

docker-compose run composer require phpmailer/phpmailer

THONG TIN THE 
Ngân hàng	NCB
Số thẻ	9704198526191432198
Tên chủ thẻ	NGUYEN VAN A
Ngày phát hành	07/15
Mật khẩu OTP	123456
