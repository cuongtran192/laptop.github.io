<?php
include('menu.php');
// Kết nối đến cơ sở dữ liệu MySQL
$conn = mysqli_connect("localhost", "root", "", "project3");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Cập nhật thông tin người dùng
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET username='$username', email='$email', phone='$phone', address='$address', password='$password' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Cập nhật thông tin người dùng thành công"); window.location.href = "admin_users.php";</script>';
    } else {
        echo '<script>alert("Lỗi: ' . mysqli_error($conn) . '");</script>';
    }
}

// Xóa người dùng
if (isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];

    $sql = "DELETE FROM users WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Xóa người dùng thành công"); window.location.href = "admin_users.php";</script>';
    } else {
        echo '<script>alert("Lỗi: ' . mysqli_error($conn) . '");</script>';
    }
}

// Truy vấn dữ liệu người dùng từ bảng "users"
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang quản lý tài khoản</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Danh sách người dùng</h2>
        <a href="create_user.php" class="btn btn-primary">Thêm người dùng</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Mật khẩu</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_user.php?id=" . $row['id'] . "'>Sửa</a> | ";
                    echo "<a href='?delete_user=" . $row['id'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa người dùng này?\")'>Xóa</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>


    <?php
    // Đóng kết nối sau khi sử dụng dữ liệu
    mysqli_close($conn);
    ?>
</body>
</html>
