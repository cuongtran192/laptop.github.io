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

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $product_id = $_GET['id'];

        $query_product = "SELECT * FROM products WHERE id = :id";
        $stmt_product = $pdo->prepare($query_product);
        $stmt_product->bindParam(':id', $product_id);
        $stmt_product->execute();
        $product = $stmt_product->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];

        // Kiểm tra xem sản phẩm có tồn tại hay không
        $query_check_product = "SELECT * FROM products WHERE id = :id";
        $stmt_check_product = $pdo->prepare($query_check_product);
        $stmt_check_product->bindParam(':id', $product_id);
        $stmt_check_product->execute();
        $existing_product = $stmt_check_product->fetch(PDO::FETCH_ASSOC);

        if (!$existing_product) {
            echo "Sản phẩm không tồn tại.";
            exit;
        }

        // Thực hiện truy vấn UPDATE
        $query_update_product = "UPDATE products SET name = :name, description = :description, price = :price, category_id = :category_id WHERE id = :id";
        $stmt_update_product = $pdo->prepare($query_update_product);
        $stmt_update_product->bindParam(':name', $name);
        $stmt_update_product->bindParam(':description', $description);
        $stmt_update_product->bindParam(':price', $price);
        $stmt_update_product->bindParam(':category_id', $category_id);
        $stmt_update_product->bindParam(':id', $product_id);
        $stmt_update_product->execute();

        // Chuyển hướng về trang quản lý sản phẩm
        header("Location: manage_products.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa sản phẩm - Trang admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-9I6oIH7yCJUD6E+0oxzeboFzJg7VYY3qFmxO7VhtXRSIOYRgJlOyZF/lcGwtpNy0+gZ5RtZfLxj2Q9i1gs5y1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Sửa sản phẩm</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea name="description" id="description" class="form-control"><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" name="price" id="price" class="form-control" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="category_id">Danh mục:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id']; ?>" <?php if ($product['category_id'] == $category['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
    
</body>
</html>
