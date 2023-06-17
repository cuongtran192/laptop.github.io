<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
</html>
<?php
// Kết nối database
$conn = mysqli_connect("localhost", "root", "", "project3");
// Kiểm tra kết nối
if (!$conn) {
die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy dữ liệu từ form đăng ký
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Kiểm tra xem tên đăng nhập đã được sử dụng chưa
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
echo "Tên đăng nhập đã tồn tại, vui lòng sử dụng tên khác.";
echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng sử dụng tên đăng nhập khác.')</script>";
echo "<script>window.location.href='register.php'</script>";
} else {
    // Thêm dữ liệu vào database
    $sql = "INSERT INTO users (username, password, email, phone, address) VALUES ('$username', '$password', '$email', '$phone', '$address')";
    $result = mysqli_query($conn, $sql);
    if (isset($result)) {
        echo "<script>alert('Đăng ký tài khoản thành công.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Đăng ký tài khoản thất bại!');</script>";
        echo '<a href="register.php">Quay lại</a>';
    }
}

// Đóng kết nối
mysqli_close($conn);
?>