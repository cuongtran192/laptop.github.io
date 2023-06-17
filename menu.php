



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPTOPSTORE</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"
 media="screen" href="css/style.php">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="image/logo1.png" alt="Logo" width="100" height="70"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Laptop
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="asus.php">Asus</a></li>
                        <li><a class="dropdown-item" href="acer.php">Acer</a></li>
                        <li><a class="dropdown-item" href="msi.php">MSI</a></li>
                        <li><a class="dropdown-item" href="gigabyte.php">Gigabyte</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Phụ kiện
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="tainghe.php">Tai nghe</a></li>
                        <li><a class="dropdown-item" href="chuot.php">Chuột</a></li>
                        <li><a class="dropdown-item" href="banphim.php">Bàn phím</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Chính sách</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tuyển dụng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hỗ trợ</a>
                </li>
            </ul>
            <form class="d-flex" action="search.php" role="search" method="GET">
          <input name ="search" class="form-control me-2 fs-6" type="search" placeholder="Tìm kiếm" aria-label="Search">
          <button class="btn btn-outline-success fs-6" type="submit">Search</button>
        </form>
            <?php 
    session_start();
    if(isset($_SESSION['username'])){
        if(isset($_POST['logout'])){
            session_destroy();
            header('location:index.php');
        }
?>
<div style="text-align: right;">
    <form style="display: inline-block;" class="logout" action="" method="post" enctype="multipart/form-data">
        <input class="btn btn-purple text-right" type="submit" name="logout" value="Đăng xuất" />
    </form>
    <a href="/laptop/giohang.php"><button class="btn btn-purple">Giỏ hàng</button></a>
    <a href="/laptop/user_info.php"><button class="btn btn-purple"><?php echo $_SESSION['username']; ?></button></a>
</div>
<?php
    } else {
?>
<div style="text-align: right;">
    <a href="/laptop/register.php"><button class="btn btn-purple">Đăng ký</button></a>
    <a href="/laptop/login.php"><button class="btn btn-purple">Đăng nhập</button></a>
</div>
<?php
    }
?>
    </div>
    </div>
</div>
</nav>