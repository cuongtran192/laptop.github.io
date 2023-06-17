<?php
// start the session
session_start();

// check if the user submitted the login form
if (isset($_POST['submit'])) {
    // get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // connect to the database
    $conn = mysqli_connect("localhost", "root", "", "project3");

    // check if the connection is successful
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // escape the username to prevent SQL injection
    $escapedUsername = mysqli_real_escape_string($conn, $username);

    // query the database to check the username and password
    $sql = "SELECT * FROM admins WHERE usernames = '$escapedUsername' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // check if a row is returned
    if (mysqli_num_rows($result) == 1) {
        // set the username in the session
        $_SESSION['admin_username'] = $username;

        // redirect to the home page
        header('Location: admin_dashboard.php');
        exit;
    } else {
        // display an error message
        echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng."); window.history.back();</script>';
    }

    // close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="login-box">
    <h2>ADMIN LOGIN</h2>
    <form action="login_proces.php" method="POST">
        <div class="user-box">
            <input type="text" class="form-control" id="usernames" name="username" required>
            <label for="usernames">Tên đăng nhập:</label>
        </div>
        <div class="user-box">
            <input type="password" class="form-control" id="password"  name="password" required>
            <label for="password">Mật khẩu:</label>
        </div>
        <a href="#" onclick="document.forms[0].submit(); return false;">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Đăng nhập
        </a>
    </form>
</div>

</body>
</html>




