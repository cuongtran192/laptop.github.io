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
} catch (PDOException $e) {
    echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image']['name'];

    // Upload file ảnh
    $target_directory = "sanpham/";
    $target_file = $target_directory . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Thực hiện truy vấn INSERT
    $query_insert_product = "INSERT INTO products (id, name, description, price, category_id, image) VALUES (:id, :name, :description, :price, :category_id, :image)";
    $stmt_insert_product = $pdo->prepare($query_insert_product);
    $stmt_insert_product->bindParam(':id', $id);
    $stmt_insert_product->bindParam(':name', $name);
    $stmt_insert_product->bindParam(':description', $description);
    $stmt_insert_product->bindParam(':price', $price);
    $stmt_insert_product->bindParam(':category_id', $category_id);
    $stmt_insert_product->bindParam(':image', $image);
    $stmt_insert_product->execute();

    // Chuyển hướng về trang quản lý sản phẩm
    header("Location: manage_products.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm sản phẩm mới - Trang admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-9I6oIH7yCJUD6E+0oxzeboFzJg7VYY3qFmxO7VhtXRSIOYRgJlOyZF/lcGwtpNy0+gZ5RtZfLxj2Q9i1gs5y1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .form-group {
            margin-bottom: 20px;
        }
        .btn-save {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm sản phẩm mới</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Mã sản phẩm:</label>
                <input type="text" name="id" id="id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category_id">Danh mục:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh:</label>
                <input type="file" name="image" id="image" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-save">Lưu</button>
        </form>
    </div>
</body>
</html>
