

<?php include('connectdb.php');
// Kiểm tra xem người dùng đã đăng nhập là admin hay không
if (isset($_SESSION['admin_username'])) {
  // Nếu người dùng đã đăng nhập là admin, hủy bỏ session admin để không ảnh hưởng đến trang người dùng
  unset($_SESSION['admin_username']);
}
if (isset($_POST['id'], $_POST['name'], $_POST['price'], $_POST['quantity'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $quantity = $_POST['quantity'];

  // Initialize cart
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
  }

  // Check if item already exists in cart
  $index = array_search($id, array_column($_SESSION['cart'], 'id'));
  if ($index !== false) {
      $_SESSION['cart'][$index]['quantity'] += $quantity;
  } else {
      // Add item to cart
      $item = array('id' => $id, 'name' => $name, 'price' => $price, 'quantity' => $quantity);
      array_push($_SESSION['cart'], $item);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-9I6oIH7yCJUD6E+0oxzeboFzJg7VYY3qFmxO7VhtXRSIOYRgJlOyZF/lcGwtpNy0+gZ5RtZfLxj2Q9i1gs5y1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.php">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="image/logo1.png" alt="Logo" width="100" height="200"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Trang chủ</a>
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
          <input name ="search" class="form-control me-2 fs-6" type="search" placeholder="Bạn muốn tìm gì ?" aria-label="Search">
          <button class="btn btn-outline-success fs-6" type="submit">Tìm kiếm</button>
        </form>
            <?php 
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $cart = $_SESSION['cart'];
    setcookie('cart', serialize($cart), time() + (86400 * 30), "/"); // Lưu cookie trong 30 ngày
}

// Đọc giỏ hàng từ cookie
if (isset($_COOKIE['cart'])) {
    $cart = unserialize($_COOKIE['cart']);
}
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
<div style="display: flex;">
  <img src="image/image2.jpg" style="width: 50%; object-fit: contain;">
  <img src="image/image3.png" style="width: 50%; object-fit: contain;">
</div>


<div class="title">HÂN HẠNH ĐƯỢC HỢP TÁC VỚI CÁC THƯƠNG HIỆU LỚN</div>
    <div class="brand">
    <a href="asus.php">
        <img src="image/logo/logo1.png" alt="Logo 1">
    </a>
    <a href="msi.php">
        <img src="image/logo/logo2.png" alt="Logo 2">
    </a>
    <a href="acer.php">
        <img src="image/logo/logo3.png" alt="Logo 3">
    </a>
    <a href="gigabyte.php">
        <img src="image/logo/logo4.png" alt="Logo 4">
    </a>
    <a href="https://example.com">
        <img src="image/logo/logo5.png" alt="Logo 5">
    </a>
    <a href="https://example.com">
        <img src="image/logo/logo6.png" alt="Logo 6">
    </a>
    <a href="https://example.com">
        <img src="image/logo/logo7.png" alt="Logo 7">
    </a>
    <a href="https://example.com">
        <img src="image/logo/logo8.png" alt="Logo 8">
    </a>
</div>
    <div class="banner">
  <img src="banner/1.png" alt="Banner Image">
</div>
    <div class="title"> CÁC MẪU LAPTOP HOT NHẤT MỚI VỀ </div>
    <div class="row row-cols-2 row-cols-md-5 g-0 product-grid" style="float:left;">
  <?php
  $sql = "SELECT * FROM products WHERE category_id IN (1, 2, 3, 4) ORDER BY RAND() LIMIT 5";

  if($result = mysqli_query($connect, $sql)) {
    while($row = mysqli_fetch_array($result)){
      echo "<div class=\"col text-center px-0\">";
      echo "<div class=\"card h-100 small-card\">";
      echo "<img class=\"card-img-top\" src=\"admin/sanpham/". $row['image']."\" alt=\"\" style=\"display:inline;\">";  
      echo "<div class=\"card-body\">";
      echo "<h5 class=\"card-title\">".$row['name']."</h5>";
      echo "<h5 class=\"card-text\">Giá: ". number_format($row['price'], 0, ',', '.') . " ₫</h5>";
      echo "</div>";
      echo "<div class=\"card-footer\">";
      echo "<form method=\"post\" action=\"giohang.php\">";
      echo "<input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\">";
      echo "<input type=\"hidden\" name=\"name\" value=\"" . $row['name'] . "\">";
      echo "<input type=\"hidden\" name=\"price\" value=\"" . $row['price'] . "\">";
      echo "<input type=\"hidden\" name=\"quantity\" value=\"1\">";
      echo "<button class=\"btn btn-primary\" type=\"submit\">Thêm vào giỏ hàng</button>";
      echo "</form>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
    mysqli_free_result($result);
  } else {
    echo "ERROR: Không thể thực thi $sql. " . mysqli_error($connect);
  }
  ?>
</div>

<div class="banner">
  <img src="banner/2.jpg" alt="Banner Image">
</div>
<div class="title"> MẪU CHUỘT BÀN PHÍM HOT 2023 </div>
<div class="row row-cols-2 row-cols-md-5 g-0 product-grid" style="float:left;">
  <?php
  $sql = "SELECT * FROM products WHERE category_id IN (6, 7) ORDER BY RAND() LIMIT 5";

  if($result = mysqli_query($connect, $sql)) {
    while($row = mysqli_fetch_array($result)){
      echo "<div class=\"col text-center px-0\">";
      echo "<div class=\"card h-100 small-card\">";
      echo "<img class=\"card-img-top\" src=\"admin/sanpham/". $row['image']."\" alt=\"\" style=\"display:inline;\">";  
      echo "<div class=\"card-body\">";
      echo "<h5 class=\"card-title\">".$row['name']."</h5>";
      echo "<h5 class=\"card-text\">Giá: ". number_format($row['price'], 0, ',', '.') . " ₫</h5>";
      echo "</div>";
      echo "<div class=\"card-footer\">";
      echo "<form method=\"post\" action=\"giohang.php\">";
      echo "<input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\">";
      echo "<input type=\"hidden\" name=\"name\" value=\"" . $row['name'] . "\">";
      echo "<input type=\"hidden\" name=\"price\" value=\"" . $row['price'] . "\">";
      echo "<input type=\"hidden\" name=\"quantity\" value=\"1\">";
      echo "<button class=\"btn btn-primary\" type=\"submit\">Thêm vào giỏ hàng</button>";
      echo "</form>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
    mysqli_free_result($result);
  } else {
    echo "ERROR: Không thể thực thi $sql. " . mysqli_error($connect);
  }
  ?>
</div>

<div class="banner">
  <img src="banner/3.jpg" alt="Banner Image">
</div>

<div class="title"> TAI NGHE FOR BIGSALE </div>
<div class="row row-cols-2 row-cols-md-5 g-0 product-grid" style="float:left;">
  <?php
  $sql = "SELECT * FROM products WHERE category_id IN (5) ORDER BY RAND() LIMIT 5";

  if($result = mysqli_query($connect, $sql)) {
    while($row = mysqli_fetch_array($result)){
      echo "<div class=\"col text-center px-0\">";
      echo "<div class=\"card h-100 small-card\">";
      echo "<img class=\"card-img-top\" src=\"admin/sanpham/". $row['image']."\" alt=\"\" style=\"display:inline;\">";  
      echo "<div class=\"card-body\">";
      echo "<h5 class=\"card-title\">".$row['name']."</h5>";
      echo "<h5 class=\"card-text\">Giá: ". number_format($row['price'], 0, ',', '.') . " ₫</h5>";
      echo "</div>";
      echo "<div class=\"card-footer\">";
      echo "<form method=\"post\" action=\"giohang.php\">";
      echo "<input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\">";
      echo "<input type=\"hidden\" name=\"name\" value=\"" . $row['name'] . "\">";
      echo "<input type=\"hidden\" name=\"price\" value=\"" . $row['price'] . "\">";
      echo "<input type=\"hidden\" name=\"quantity\" value=\"1\">";
      echo "<button class=\"btn btn-primary\" type=\"submit\">Thêm vào giỏ hàng</button>";
      echo "</form>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    }
    mysqli_free_result($result);
  } else {
    echo "ERROR: Không thể thực thi $sql. " . mysqli_error($connect);
  }
  ?>
</div>




<?php include('footer.php'); ?>
