<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"
 media="screen" href="css/style.php">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <link rel="icon" href="image/logo.ico">
</head>
<body>
  <div class="user-info-container">
  <?php 
session_start();
include('connectdb.php');
if(!isset($_SESSION['username'])){
header("Location:/laptop/login.php");
}

$username = $_SESSION['username'];

$query_user = "SELECT * FROM users WHERE username='$username'";
$result_user = mysqli_query($connect, $query_user);
$user_data = mysqli_fetch_assoc($result_user);

if(isset($_POST['submit'])) {
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$query_update_user = "UPDATE users SET  email='$email', phone='$phone', address='$address' WHERE username='$username'";
mysqli_query($connect, $query_update_user);

echo '<script language="javascript">';
echo 'alert("Cập nhật thông tin thành công")';
echo '</script>';

$_SESSION['username'] = $username;
$username = $_SESSION['username'];
$query_user = "SELECT * FROM users WHERE username='$username'";
$result_user = mysqli_query($connect, $query_user);
$user_data = mysqli_fetch_assoc($result_user);
}

mysqli_close($connect);
?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="mb-4">Thông tin người dùng</h2>
      <form method="POST" action="">
        <div class="form-group">
          <label for="username">Họ tên:</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data['username']; ?>"readonly>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>">
        </div>
        <div class="form-group">
          <label for="address">Địa chỉ:</label>
          <input type="text" class="form-control" id="address" name="address" value="<?php echo $user_data['address']; ?>">
        </div>
        <div class="form-group">
          <label for="phone">Số điện thoại:</label>
          <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" >
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Cập nhật thông tin</button>
        <a href="/laptop/change_password.php" class="btn btn-secondary ml-3">Đổi mật khẩu</a>
        <a href="/laptop/index.php" class="btn btn-secondary ml-3">TRANG CHỦ</a>
      </form>
    </div>
  </div>
</div>