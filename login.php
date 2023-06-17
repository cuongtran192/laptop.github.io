<?php
// start the session
session_start();

// check if the user submitted the login form
if (isset($_POST['submit'])) {
    // get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if the username and password are correct
    if ($username === 'admin' && $password === '123456') {
        // set the username in the session
        $_SESSION['username'] = $username;

        // redirect to the home page
        header('Location: index.php');
        exit;
    } else {
        // display an error message
        echo 'Incorrect username or password';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/background-realistic-abstract-technology-particle_23-2148431735.jpg?w=1380&t=st=1685859621~exp=1685860221~hmac=9478748e6a24a7a39d54465086f4cdb12b0483117487cd215470a24ce1bd6f84');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
        }

        .login-form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 300px;
        }

        .login-header {
            margin-bottom: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333333;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('.login-form').addClass('animate__animated animate__fadeIn');
        });
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="login-header">
                Hello . Login Now !
            </div>
            <form action="login_process.php" method="POST">
                <div class="form-group">
                    <label for="usernames">Tên đăng nhập:</label>
                    <input type="text" class="form-control" id="usernames" placeholder="Nhập tên đăng nhập" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Đăng nhập</button>
                <div class="mt-3">
        <a href="register.php">Đăng ký tài khoản mới</a>
    </div>
            </form>
        </div>
    </div>
</body>
</html>
