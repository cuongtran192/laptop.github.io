<?php
// Kiểm tra xem có tham số 'id' trong URL hay không
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project3";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Xóa sản phẩm từ cơ sở dữ liệu
        $query_delete = "DELETE FROM products WHERE id = :product_id";
        $stmt_delete = $pdo->prepare($query_delete);
        $stmt_delete->bindParam(':product_id', $product_id);
        $stmt_delete->execute();

        // Chuyển hướng trở lại trang quản lý sản phẩm
        header("Location: manage_products.php");
        exit;
    } catch (PDOException $e) {
        echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
        exit;
    }
} else {
    echo "Không tìm thấy sản phẩm cần xóa.";
    exit;
}
?>
