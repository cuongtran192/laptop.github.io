<?php include('connectdb.php');
session_start();

// Kiểm tra xem $_SESSION['cart'] có giá trị hay không
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    // Tiếp tục xử lý giỏ hàng và thanh toán
    foreach ($cart as $index => $item) {
        // Xử lý và hiển thị thông tin sản phẩm trong giỏ hàng
    }
} else {
    // Thông báo giỏ hàng trống hoặc xử lý khi không có giỏ hàng
}
?>

<!-- Tiếp tục mã HTML của trang checkout.php -->

``



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.php">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-3 mb-4">Thanh toán</h1>

        <h3 class="mb-3">Thông tin đơn hàng</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cart = $_SESSION['cart'];
                    $total = 0;
                    foreach ($cart as $index => $item) {
                        $sub_total = $item['price'] * $item['quantity'];
                        $total += $sub_total;
                    ?>
                        <tr>
                            <td><?php echo (int)$index + 1; ?></td>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo number_format($item['price']); ?> $</td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($sub_total); ?> $</td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4" class="text-right">Tổng cộng:</td>
                        <td colspan="1" class="font-weight-bold"><?php echo number_format($total); ?> $</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="mt-4 mb-3">Thông tin thanh toán</h3>
        <form method="post" action="process_payment.php">
            <div class="mb-3">
                <label for="payment_method" class="form-label">Phương thức thanh toán:</label>
                <select class="form-select" name="payment_method" id="payment_method">
                    <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                    <option value="credit_card">Thẻ tín dụng</option>
                    <option value="cash_on_delivery">Thanh toán khi nhận hàng</option>
                </select>
            </div>

            <div class="mb-3">
    <label for="sdt" class="form-label">Số điện thoại:</label>
    <input type="text" class="form-control" name="sdt" id="sdt" placeholder="Nhập số điện thoại">
</div>

<div class="mb-3">
    <label for="ten" class="form-label">Tên:</label>
    <input type="text" class="form-control" name="ten" id="ten" placeholder="Nhập tên">
</div>

<div class="mb-3">
    <label for="address" class="form-label">Địa chỉ giao hàng:</label>
    <textarea class="form-control" name="address" id="address" placeholder="Nhập địa chỉ" rows="3" required></textarea>
</div>

            <button type="submit" class="btn btn-primary">Hoàn tất thanh toán</button>
        </form>
    </div>
</body>

</html>
