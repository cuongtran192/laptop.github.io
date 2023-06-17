<?php header("Content-type: text/css"); ?> 
body {
    background-color:#FFFFFF;
}
nav {
  background-color: blue;
}
.navbar.navbar-expand-lg.navbar-light.bg-light {
  height: 100px; /* Đặt chiều cao thanh menu */
  background-color: #444444; /* Đặt màu nền cho thanh menu */
  box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1); /* Thêm đổ bóng cho thanh menu */
}
<style>

.top-bar{
  text-align:right;
}
.dropdown-menu-animated {
  animation-duration: 0.5s;
}



.navbar-brand img {
  height: 180px; /* Đặt kích thước cho logo */
  width: 250px;
}

.navbar-nav .nav-link {
  margin-right: 20px; /* Đặt khoảng cách giữa các phần tử trong thanh menu */
  font-size: 20px; /* Đặt kích thước chữ cho các phần tử trong thanh menu */
  color: #000; /* Đặt màu chữ cho các phần tử trong thanh menu */
}

.form-control {
  height: 40px; /* Đặt chiều cao cho ô tìm kiếm */
  border-radius: 20px; /* Đặt bo tròn cho ô tìm kiếm */
}

.btn-outline-success {
  height: 40px; /* Đặt chiều cao cho nút tìm kiếm */
  width: 150px;
  border-radius: 20px; /* Đặt bo tròn cho nút tìm kiếm */
}
.btn-purple {
  background-color: purple;
  color: white;
}
.card-title {
    font-size: 15px;
}

.card-text {
    font-size: 14px;
}
.small-card {
  max-width: 400px;
  
}
.card {
  margin-bottom: 0px;
}
.row.no-gutters {
  margin-right: 0;
  margin-left: 0;
}

.no-gutters [class*='col-'] {
  padding-right: 0;
  padding-left: 0;
}

.brand {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }
        
        .brand img {
            width: 100px;
            height: auto;
            margin: 0 40px;
            object-fit: contain;
        transition: transform 0.3s ease;
        }

        
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            margin-top: 50px;
        }
        .brand img:hover {
        transform: scale(1.2);
      }
</style>
.card {
  margin-bottom: 0px;
}
.row.no-gutters {
  margin-right: 0;
  margin-left: 0;
}

.no-gutters [class*='col-'] {
  padding-right: 0;
  padding-left: 0;
}

.product-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center; /* Căn giữa theo chiều ngang */
}

.product-grid .col {
  /* Định nghĩa các thuộc tính CSS để điều chỉnh kích thước và hiển thị của các ô */
  /* Ví dụ: */
  width: 100%;
  max-width: 15%;
  padding: 20px;
  border: none; /* Loại bỏ viền */
  margin-bottom: 10px; /* Tạo khoảng trắng nhỏ giữa các ô */
}

.product-grid .col:not(:last-child) {
  margin-bottom: 10px; /* Tạo khoảng trắng nhỏ giữa các ô, trừ ô cuối cùng */
}

.product-grid .col .card {
  border: none; /* Loại bỏ viền cho các thẻ card */
}
.card-footer {
  border-top: none;
}
.card-footer button.btn-primary {
  background-color: #ff0000;
  color: #ffdddd;
  border: none; /* Loại bỏ viền */
  outline: none; /* Loại bỏ đường viền khi focus */
  transition: background-color 0.3s ease;
}

.card-footer button.btn-primary:hover {
  background-color: #ff9999; /* Màu nền sáng lên khi di chuột vào */
}
.banner {
  display: flex;
  justify-content: center;
  width: 100%;
  height: 45vh;
  margin-top: 60px;
}

.banner img {
  max-width: 150%;
  max-height: 150%;
}