<?php
include('connectdb.php');
include('menu.php');
?>
<div class="row">
  <div class="col-md-4">
    <form method="get">
      <div class="input-group mb-3">
        <select class="form-select" name="sort">
          <option value="">Sắp xếp theo</option>
          <option value="asc">Giá tăng dần</option>
          <option value="desc">Giá giảm dần</option>
        </select>
        <button class="btn btn-outline-secondary" type="submit">Lọc</button>
      </div>
    </form>
  </div>
</div>

<div class="row row-cols-2 row-cols-md-6 g-0" style="float:left;">
  <?php
  $sql = "SELECT * FROM products WHERE category_id='3'";

  if(isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if($sort == 'asc') {
      $sql .= " ORDER BY price ASC";
    } else if($sort == 'desc') {
      $sql .= " ORDER BY price DESC";
    }
  }

  if($result = mysqli_query($connect, $sql)) {
    while($row = mysqli_fetch_array($result)){
      echo "<div class=\"col text-center px-0\">";
      echo "<div class=\"card h-100 small-card\">";
      echo '<img class="card-img-top" src="admin/sanpham/' . $row['image'] . '" alt="" style="display:inline;">'; 
      echo "<div class=\"card-body\">";
      echo "<h5 class=\"card-title\">".$row['name']."</h5>";
      echo "<p class=\"card-text\">Thông số:<br>" . str_replace(", ", "<br>", $row['description']) . "</p>";
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
