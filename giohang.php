<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"
 media="screen" href="css/style.php">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<a href=""></a>
<body>
  <div class="user-info-container">
<?php
include('connectdb.php');
session_start();

if (!isset($_SESSION['username'])) {
  // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
  echo '<script>alert("Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng."); window.location.href = "login.php";</script>';
  exit(); // Kết thúc kịch bản hiện tại
}


if (isset($_POST['id'], $_POST['name'], $_POST['price'], $_POST['quantity'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Initialize cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if item already exists in cart
    $index = array_search($id, array_column($_SESSION['cart'], 'id'));
    if ($index !== false) {
        $_SESSION['cart'][$index]['quantity'] += $quantity;
    } else {
        // Add item to cart
        $item = array('id' => $id, 'name' => $name, 'price' => $price, 'quantity' => $quantity);
        array_push($_SESSION['cart'], $item);
    }
}

// Remove item from cart
if (isset($_GET['action'], $_GET['index']) && $_GET['action'] == 'delete') {
    $index = $_GET['index'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Update item quantities in cart
if (isset($_POST['submit'])) {
    $quantities = $_POST['quantity'];
    foreach ($quantities as $index => $quantity) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
    }
}

?>

<div class="container">
    <h1 class="text-center mt-3 mb-4">Giỏ hàng</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Thao tác</th>
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
                        <td>
                            <form method="post">
                                <input type="number" name="quantity[]" value="<?php echo $item['quantity']; ?>" min="1">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                        </td>
                        <td><?php echo number_format($sub_total); ?> $</td>
                        <td>
                            <a href="?action=delete&index=<?php echo $index; ?>">Xóa</a>
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                            </form>
                            </td>
</tr>
<?php
}
?>
<tr>
    <td colspan="4" class="text-right">Tổng cộng:</td>
    <td colspan="2" class="font-weight-bold"><?php echo number_format($total); ?> $</td>
</tr>
</tbody>
</table>
<div class="text-center">
<a href="index.php" class="btn btn-primary btn-lg">Tiếp tục mua hàng</a>

    <?php
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    ?>
        <a href="checkout.php" class="btn btn-success btn-lg">Thanh toán</a>
    <?php
    }
    ?>
</div>
</div>
<?php
?>
