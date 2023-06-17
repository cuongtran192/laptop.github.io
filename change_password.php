<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"
 media="screen" href="css/style.php">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <title>Phone Store</title>
  <link rel="icon" href="image/favicon.ico">
</head>

<body>
  <div class="user-info-container">
  <?php 
session_start();
include('connectdb.php');

if(!isset($_SESSION['username'])){
    header("Location:/laptop/login.php");
    exit();
}

$username = $_SESSION['username'];

if(isset($_POST['submit'])) {
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $query_user = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result_user = mysqli_query($connect, $query_user);
    $user_data = mysqli_fetch_assoc($result_user);

    if($user_data) {
        if($new_password == $confirm_password) {
            $query_update_password = "UPDATE users SET password='$new_password' WHERE username='$username'";
            mysqli_query($connect, $query_update_password);

            echo '<script language="javascript">';
            echo 'alert("Đổi mật khẩu thành công")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Mật khẩu xác nhận không khớp")';
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Mật khẩu cũ không đúng")';
        echo '</script>';
    }
}

mysqli_close($connect);
?>
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="mb-4">Đổi mật khẩu</h2>
      <form method="POST" action="">
        <div class="form-group">
          <label for="password">Mật khẩu cũ:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label for="new_password">Mật khẩu mới:</label>
          <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
          <label for="confirm_password">Xác nhận mật khẩu mới:</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Đổi mật khẩu</button>
        <a href="/laptop/user_info.php" class="btn btn-secondary ml-3">Quay lại</a>
      </form>
    </div>
  </div>
</div>