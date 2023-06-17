<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['username'])) {
    // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    echo '<script>alert("Bạn cần đăng nhập để tiến hành thanh toán."); window.location.href = "login.php";</script>';
    exit(); // Kết thúc kịch bản hiện tại
}

// Kiểm tra giỏ hàng có sản phẩm hay không
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo '<script>alert("Giỏ hàng của bạn hiện đang trống."); window.location.href = "index.php";</script>';
    exit(); // Kết thúc kịch bản hiện tại
}
$diachi = $_POST['address']; // Lấy giá trị từ trường nhập "Địa chỉ" trong form
$ten = $_POST['ten']; // Lấy giá trị từ trường nhập "Địa chỉ" trong form
$sdt = $_POST['sdt']; // Lấy giá trị từ trường nhập "Địa chỉ" trong form



// Tạo kết nối PDO đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project3";

try {
    // Tạo kết nối PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Cấu hình PDO để báo lỗi khi có lỗi xảy ra
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
    $id = $_SESSION['id'] ?? null; // Sử dụng toán tử null coalescing để đảm bảo nếu 'user_id' không tồn tại trong $_SESSION
    $total = 0;

    // Tính tổng giá trị đơn hàng từ giỏ hàng
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    if ($id === null) {
        echo '<script>alert("Không tìm thấy thông tin người dùng. Vui lòng đăng nhập lại."); window.location.href = "login.php";</script>';
        exit();
    }

    // Tạo bản ghi trong bảng `orders`
$query = "INSERT INTO orders (user_id, total_price, order_date, diachi, sdt, ten) VALUES (?, ?, NOW(), ?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$id, $total, $diachi, $sdt, $ten]);


    // Lấy ID đơn hàng vừa được tạo
    $order_id = $pdo->lastInsertId();

    // Tạo bản ghi trong bảng `order_items` cho từng sản phẩm trong giỏ hàng
    $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);

    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $stmt->execute([$order_id, $product_id, $quantity, $price]);
    }

    // Sau khi xử lý thành công, hiển thị thông báo và xóa giỏ hàng
    echo '<script>alert("Thanh toán thành công. Đơn hàng của bạn đã được gửi đi, Cảm ơn bạn đã mua hàng!"); window.location.href = "index.php";</script>';
    unset($_SESSION['cart']);
    exit(); // Kết thúc kịch bản hiện tại
} catch (PDOException $e) {
    echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
    exit(); // Kết thúc kịch bản hiện tại nếu không thể kết nối cơ sở dữ liệu
}
?>
