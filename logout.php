<?php
session_start(); // Khởi tạo session
unset($_SESSION['username']); // Xoá session
session_destroy(); // Hủy tất cả các session
header("Location: login.php"); // Chuyển hướng về trang đăng nhập
exit(); // Dừng chương trình
?>