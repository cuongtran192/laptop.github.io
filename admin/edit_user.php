<?php
include('menu.php');

// Kết nối đến cơ sở dữ liệu MySQL
$conn = mysqli_connect("localhost", "root", "", "project3");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy ID người dùng từ URL
$id = $_GET['id'];

// Lấy thông tin người dùng từ cơ sở dữ liệu
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Cập nhật thông tin người dùng
if (isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $sql = "UPDATE users SET username='$username', email='$email', phone='$phone', address='$address', password='$password' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Cập nhật thông tin người dùng thành công";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối sau khi sử dụng dữ liệu
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa thông tin người dùng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa thông tin người dùng</h2>
        <form method="POST">
            <div class="form-group">
                <label>Tên người dùng:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>" required>
            </div>
            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" name="password" class="form-control" value="<?php echo $row['password']; ?>" required>
            </div>
            <button type="submit" name="update_user" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>
</html>
