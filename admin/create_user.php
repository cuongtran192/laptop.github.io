<?php
include('menu.php');
// Kết nối đến cơ sở dữ liệu MySQL
$conn = mysqli_connect("localhost", "root", "", "project3");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Kiểm tra xem username đã tồn tại hay chưa
    $checkUsernameQuery = "SELECT * FROM users WHERE username='$username'";
    $checkUsernameResult = mysqli_query($conn, $checkUsernameQuery);
    if (mysqli_num_rows($checkUsernameResult) > 0) {
        echo '<script>alert("Tên người dùng đã tồn tại");</script>';
    } else {
        // Thêm người dùng mới
        $addUserQuery = "INSERT INTO users (username, email, phone, address, password) VALUES ('$username', '$email', '$phone', '$address', '$password')";
        if (mysqli_query($conn, $addUserQuery)) {
            echo '<script>alert("Thêm người dùng thành công");</script>';
        } else {
            echo '<script>alert("Lỗi: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang quản lý tài khoản</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


    <div class="container">
        <h2>Thêm người dùng</h2>
        <form method="POST">
            <div class="form-group">
                <label>Tên người dùng:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="add_user" class="btn btn-primary">Thêm</button>
        </form>
    </div>

    <?php
    // Đóng kết nối sau khi sử dụng dữ liệu
    mysqli_close($conn);
    ?>
</body>
</html>
