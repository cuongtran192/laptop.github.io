<?php
// Khởi động session để lưu giỏ hàng
session_start();

// Lấy thông tin sản phẩm từ phương thức POST
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

// Kiểm tra nếu giỏ hàng chưa được khởi tạo thì khởi tạo nó
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
if (isset($_SESSION['cart'][$id])) {
    // Nếu đã có, tăng số lượng sản phẩm lên
    $_SESSION['cart'][$id]['quantity'] += $quantity;
} else {
    // Nếu chưa có, thêm sản phẩm vào giỏ hàng
    $_SESSION['cart'][$id] = array(
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity
    );
}

// Chuyển hướng người dùng về trang giỏ hàng
header('Location: giohang.php');
exit();
?>
