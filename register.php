<!DOCTYPE html>
<html>
<head>
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/geometric-gradient-futuristic-background_23-2149116406.jpg?w=1380&t=st=1685860455~exp=1685861055~hmac=2c2f30095568dba4d541d678f4ec0c17f4d9ce5942aa6701bd73a80e884766d5');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 450px;
        }

        .login-header {
            margin-bottom: 10px;
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
		Đăng ký tài khoản
	</div>

		<form action="register_process.php" method="post">
			<div class="form-group">
				<label for="username">Tên đăng nhập:</label>
				<input type="text" class="form-control" id="username" name="username" required>
			</div>
			<div class="form-group">
				<label for="password">Mật khẩu:</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="phone">Số điện thoại:</label>
				<input type="tel" class="form-control" id="phone" name="phone" required>
			</div>
			<div class="form-group">
				<label for="address">Địa chỉ:</label>
				<textarea class="form-control" id="address" name="address" required></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Đăng ký</button>
			Bạn đã có tài khoản
			<a href="login.php">Đăng nhập</a>
    </div>

		</form>
	</div>
	</div>
</body>
</html>