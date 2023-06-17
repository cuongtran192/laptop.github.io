<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php
// Kết nối database
$conn = mysqli_connect("localhost", "root", "", "project3");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy dữ liệu từ form đăng nhập
$username = $_POST['username'];
$password = $_POST['password'];

// Kiểm tra tên đăng nhập và mật khẩu
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    // Khởi tạo session
    session_start();
    // Lấy thông tin người dùng từ kết quả truy vấn
    $user = mysqli_fetch_assoc($result);
    // Lưu tên đăng nhập và user_id vào session
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $user['id'];
    // Hiển thị thông báo đăng nhập thành công bằng JavaScript
    echo '<script>alert("Đăng nhập thành công."); window.location.href = "index.php";</script>';
} else {
    // Hiển thị thông báo đăng nhập thất bại và nút thử lại bằng JavaScript
    echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng."); window.history.back();</script>';
}

// Đóng kết nối
mysqli_close($conn);
?>

