
<?php
// Kết nối database
$conn = mysqli_connect("localhost", "root", "", "project3");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Lấy dữ liệu từ form đăng nhập và áp dụng escape để tránh SQL injection
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Kiểm tra tên đăng nhập và mật khẩu
$sql = "SELECT * FROM admins WHERE usernames = ? AND password = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    // Khởi tạo session
    session_start();
    // Lấy thông tin người dùng từ kết quả truy vấn
    $user = mysqli_fetch_assoc($result);
    // Lưu tên đăng nhập và user_id vào session
    $_SESSION['admin_username'] = $username;
    // Hiển thị thông báo đăng nhập thành công bằng JavaScript
    echo '<script>alert("Đăng nhập thành công."); window.location.href = "admin_dashboard.php";</script>';
} else {
    // Hiển thị thông báo đăng nhập thất bại và nút thử lại bằng JavaScript
    echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng."); window.history.back();</script>';
}

// Đóng kết nối
mysqli_close($conn);
?>
