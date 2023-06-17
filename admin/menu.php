<?php
// Kiểm tra xem người dùng đã đăng nhập hay chưa
session_start();
if (!isset($_SESSION['admin_username'])) {
    // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: admin_login.php");
    exit;
}

// Đăng xuất admin
if (isset($_GET['admin_logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>TRANG QUẢN TRỊ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    .sidebar {
        background-color: #444; /* Màu xám đậm */
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        transition: width 0.3s ease; /* Hiệu ứng chuyển động khi thay đổi width */
    }

    .sidebar:hover {
        width: 300px; /* Width khi rê chuột vào sidebar */
    }

    .content {
        margin-left: calc(250px + 20px);
        padding: 20px;
        background-color: #fff;
        transition: background-color 0.3s ease; /* Hiệu ứng chuyển động khi thay đổi background-color */
    }

    .content:hover {
        background-color: #f1f1f1; /* Background-color khi rê chuột vào content */
    }

    .menu {
        padding: 0;
        list-style: none;
        color: #808080
    }

    .menu-item {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .menu-item:last-child {
        border-bottom: none;
    }

    .menu-item a {
        display: block;
        text-decoration: none;
        color: #FFFFFF;
        transition: color 0.3s ease; /* Hiệu ứng chuyển động khi thay đổi màu chữ */
    }

    .menu-item:hover a {
        color: #00FFFF; /* Màu chữ khi rê chuột vào */
    }

    .menu-item:hover {
        background-color: #808080;
    }
</style>

</head>
<body>
<div class="sidebar">
<h3 style="color: white; text-transform: uppercase;"> <?php echo strtoupper($_SESSION['admin_username']); ?></h3>
    <ul class="menu">
        <li class="menu-item"><a href="admin_dashboard.php">Dashboard</a></li>
        <li class="menu-item"><a href="manage_products.php">Quản lý Sản Phẩm</a></li>
        <li class="menu-item"><a href="admin_orders.php">Quản lý Đơn Hàng</a></li>
        <li class="menu-item"><a href="admin_users.php">Quản lý Người Dùng</a></li>
        <li class="menu-item"><a href="?admin_logout=true">Đăng xuất</a></li>
    </ul>
</div>
</body>
</html>
