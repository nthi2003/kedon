<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thông tin thuốc</title>
  <link rel="stylesheet" href="../style_light.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <header>
    <a href="../index.php">QUẢN TRỊ ĐƠN THUỐC</a>
  </header>
  <nav>
    <div class="nav-left-content">
      <a href="../index.php">Trang chủ</a>
      <a href="../BenhNhan/BenhNhanMoi.php">Thêm bệnh nhân</a>
      <a href="./index.php" style="background-color: gray;">Thông tin thuốc</a>
      <a href="../Chitietdonthuoc/index.php">Thông tin kê đơn</a>
    </div>

  </nav>
  <div class="content">
    <h2>Thông tin thuốc</h2>
    <div class="searchForm">
      <form method="post" class="searchForm">
        <input type="hidden" name="form_type" value="form2">
        <input type="text" class="searchBox-input" name="search" placeholder="Tìm kiếm theo tên thuốc">
        <button type="submit" class="searchBox-button">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
    </div>
    <div class="new-patient-button">
      <a href="./themthuocmoi.php">Thêm thuốc</a>
    </div>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Tên thuốc</th>
        <th>Liều lượng tối thiểu (viên)</th>
        <th>Liều lượng tối đa (viên)</th>
        <th>Tần suất sử dụng (v/ngày)</th>
        <th>Đơn vị (mg)</th>
        <th>Hành động</th>
      </tr>
      <?php
      require_once '../connection/connect.php';

      $check = false;
      if (isset($_POST['form_type'])) {
        $check = true;
        $searchName = $_POST['search'];
        if ($check) {
          $sql = "SELECT * FROM thuoc WHERE tenThuoc LIKE '%$searchName%'"; //tìm kiếm
          $result = mysqli_query($conn, $sql);
        }
      } else {
        $sql = "SELECT * FROM thuoc ORDER BY thuocId"; // sắp xêp tăng dần

        $result = mysqli_query($conn, $sql);
      }

      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='td'>";
          echo "<td><strong>" . $row['thuocId'] . "</strong></td>";
          echo "<td>" . $row['tenThuoc'] . "</td>";
          echo "<td>" . $row['lieuToiThieu'] . "</td>";
          echo "<td>" . $row['LieuToiDa'] . "</td>";
          echo "<td>" . $row['TanXuat'] . "</td>";
          echo "<td>" . $row['Donvi'] . "</td>";
          echo "<td><a href='./sua.php?medicineId=" . $row['thuocId'] . "' class='a_sua'>Sửa</a>  <a href='./xoathuoc.php?medicineId=" . $row['thuocId'] . "' class='a_xoa'>Xóa</a></td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
      }
      mysqli_close($conn);
      ?>
    </table>
  </div>

</body>

</html>