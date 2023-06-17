<?php
include('menu.php');


$is_admin = true;

if (!$is_admin) {
    echo "Bạn không có quyền truy cập vào trang này.";
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project3";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query_categories = "SELECT * FROM categories";
    $stmt_categories = $pdo->query($query_categories);
    $categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

    $filter_category = isset($_GET['category']) ? $_GET['category'] : '';
    $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

    $query_products = "SELECT * FROM products";
    $queryParams = [];

    if ($filter_category) {
        $query_products .= " WHERE category_id = :category_id";
        $queryParams[':category_id'] = $filter_category;
    }
    
    if ($searchKeyword) {
        if ($filter_category) {
            $query_products .= " AND";
        } else {
            $query_products .= " WHERE";
        }
        $query_products .= " name LIKE :searchKeyword";
        $queryParams[':searchKeyword'] = '%' . $searchKeyword . '%';
    }

    $stmt_products = $pdo->prepare($query_products);
    $stmt_products->execute($queryParams);
    $products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý sản phẩm - Trang admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-9I6oIH7yCJUD6E+0oxzeboFzJg7VYY3qFmxO7VhtXRSIOYRgJlOyZF/lcGwtpNy0+gZ5RtZfLxj2Q9i1gs5y1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
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
        .custom-container {
            margin-top: 20px;
            margin-left: 0;
            padding-left: 15px;
        }
        .product-image {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Quản lý sản phẩm</h2>
        <div class="custom-container">
        <a href="add_product.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Thêm sản phẩm mới</a>

            <form action="" method="GET">
                <div class="mb-3">
                    <label for="search">Tìm kiếm:</label>
                    <input type="text" name="search" id="search" placeholder="Nhập tên sản phẩm..." value="<?php echo $searchKeyword; ?>">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Tìm kiếm</button>
                </div>
                <label for="category">Danh mục sản phẩm:</label>
                <select name="category" id="category">
                    <option value="">Tất cả</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id']; ?>" <?php if ($filter_category == $category['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
                <button type="submit">Lọc</button>
            </form>
        </div>
        <table class="table table-bordered table-striped table-fixed-layout">
            <thead>
                <tr>
                    <th style="width: 5%">Mã sản phẩm</th>
                    <th style="width: 5%">Hình ảnh</th>
                    <th style="width: 10%">Tên sản phẩm</th>
                    <th style="width: 15%">Mô tả</th>
                    <th style="width: 10%">Giá</th>
                    <th style="width: 10%">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td>
                            <?php
                            $imagePath = 'sanpham/' . $product['image'];
                            if (file_exists($imagePath)) {
                                echo '<img src="' . $imagePath . '" alt="Product Image" width="50" height="50">';
                            } else {
                                echo 'Hình ảnh không tồn tại';
                            }
                            ?>
                        </td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo number_format($product['price'], 0, ',', '.') . ' VNĐ'; ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Sửa</a>
                            <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"><i class="fas fa-trash"></i> Xóa</a>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
