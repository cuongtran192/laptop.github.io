
<?php
include('menu.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project3";

try {
    // Tạo kết nối PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Cấu hình PDO để báo lỗi khi có lỗi xảy ra
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Lấy danh sách đơn hàng từ bảng "orders"
    $query = "SELECT * FROM orders";
    $stmt = $pdo->query($query);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý đơn hàng - Trang admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-9I6oIH7yCJUD6E+0oxzeboFzJg7VYY3qFmxO7VhtXRSIOYRgJlOyZF/lcGwtpNy0+gZ5RtZfLxj2Q9i1gs5y1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.php">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <style>
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-fixed-layout {
            table-layout: auto;
            word-wrap: break-word;
        }
        .table-fixed-layout th,
        .table-fixed-layout td {
            white-space: nowrap;
        }
        .btn-save {
        background-color: #007bff;
        color: #fff;
    }
    .status-delivered {
        font-weight: bold;
        color: green;
    }
    .status-shipping {
        font-weight: bold;
        color: blue;
    }
    .status-canceled {
        font-weight: bold;
        color: red;

    }
    .status-processing {
        font-weight: bold;
        color: yellow;
        
    }
    .custom-container {
            margin-top: 20px;
            margin-left: 0;
            padding-left: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Quản lý đơn hàng</h2>
        <table class="table table-bordered table-striped table-fixed-layout">
            <thead>
                <tr>
                    <th style="width: 5%">Mã đơn hàng</th>
                    <th style="width: 5%">Tên khách hàng</th>
                    <th style="width: 10%">Ngày đặt hàng</th>
                    <th style="width: 15%">Địa chỉ giao hàng</th>
                    <th style="width: 20%">Sản phẩm</th>
                    <th style="width: 10%">Tổng tiền</th>
                    <th style="width: 10%">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['ten']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['diachi']; ?></td>
                    <td>
                        <?php
                        // Truy vấn danh sách sản phẩm mua hàng cho đơn hàng hiện tại
                        $order_id = $order['id'];
                        $query_items = "SELECT products.name, order_items.quantity, order_items.price 
                                        FROM order_items 
                                        JOIN products ON order_items.product_id = products.id 
                                        WHERE order_items.order_id = :order_id";
                        $stmt_items = $pdo->prepare($query_items);
                        $stmt_items->bindParam(':order_id', $order_id);
                        $stmt_items->execute();
                        $order_items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

                        // Hiển thị thông tin sản phẩm mua hàng
                        foreach ($order_items as $item) {
                            echo $item['name'] . ' - Số lượng: ' . $item['quantity'] . ' - Giá: ' . number_format($item['price'], 0, ',', '.') . ' VNĐ<br>';
                        }
                        ?>
                    </td>
                    <td><?php echo number_format($order['total_price'], 0, ',', '.') . ' VNĐ'; ?></td>
                    <td>
    <?php
    $status = $order['status'];
    switch ($status) {
        case 'delivered':
            echo '<span class="status-delivered">Đã giao</span>';
            break;
        case 'shipping':
            echo '<span class="status-shipping">Đang giao</span>';
            break;
        case 'canceled':
            echo '<span class="status-canceled">Đã hủy</span>';
            break;
        case 'processing':
            echo '<span class="status-processing">Đang xử lý</span>';
            break;
        default:
            echo 'Không xác định';
            break;
    }
    ?>
    <br>
    <form method="POST" action="update_order_status.php">
        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
        <select name="status">
            <option value="delivered">Chọn trạng thái</option>
            <option value="delivered">Đã giao</option>
            <option value="shipping">Đang giao</option>
            <option value="canceled">Đã hủy</option>
            <option value="processing">Đang xử lý</option>
        </select>
        <button type="submit" name="update_status" class="btn btn-save">Lưu</button>
    </form>
</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
