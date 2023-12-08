<?php
require_once '../connection/connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kê đơn thuốc</title>
  <link rel="stylesheet" href="../style_light.css">
</head>

<body>
  <header>
    <a href="../index.php">THÊM BỆNH NHÂN</a>
  </header>
  <nav>
    <div class="nav-left-content">
      <a href="../index.php">Trang chủ</a>
      <a href="./BenhNhanMoi.php" style="background-color: gray;">Thêm bệnh nhân</a>
      <a href="../thuoc/index.php">Thông tin thuốc</a>
      <a href="../prescription-detail/index.php">Thông tin kê đơn</a>
    </div>

  </nav>
  <div class="new-patient-form">
    <h2 style="text-align: center;">THÊM BỆNH NHÂN</h2>
    <form action="./process.php" method="post" class="form">
      <input type="hidden" name="form_type" value="form1">
      <div class="f">
        <label for="name">Họ tên:</label>
        <input type="text" class="form-input" name="name" placeholder="Tên">
      </div>
      <div class="f">
        <label for="gender">Giới tính:</label>
        <input type="text" class="form-input" name="gender" placeholder="Giới tính">
      </div>
      <div class="f">
        <label for="phone">SĐT:</label>
        <input type="text" class="form-input" name="phone" placeholder="Số điện thoại">
      </div>

      <button type="submit" class="button-form">Thêm</button>
    </form>
  </div>
  <hr>
  <div class="content">
    <h2>Danh sách bệnh nhân</h2>
    <div class="searchForm">
      <form method="post" class="searchForm">
        <input type="hidden" name="form_type" value="form2">
        <input type="text" class="searchBox-input" name="search" placeholder="Tìm kiếm theo tên">
        <button type="submit" class="searchBox-button">
          <img src="../img/search-icon.svg" alt="search-icon">
        </button>
      </form>
    </div>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Tên bệnh nhân</th>
        <th>Giới tính</th>
        <th>Số điện thoại</th>
        <th>Hành động</th>
      </tr>
      <?php
      $check = false;
      if (isset($_POST['form_type'])) {
        $check = true;
        $searchName = $_POST['search'];
        if ($check) {
          $sql = "SELECT * FROM benhnhan WHERE TenBenhNhan LIKE '%$searchName%'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr class='td'>";
              echo "<td><strong>" . $row['BenhNhanId'] . "</strong></td>";
              echo "<td>" . $row['TenBenhNhan'] . "</td>";
              echo "<td>" . $row['gioitinh'] . "</td>";
              echo "<td>" . $row['phone'] . "</td>";
              echo "<td><a href='./sua.php?patientId=" . $row['BenhNhanId'] . "' class='a_sua'>Sửa</a>  <a href='./xoa.php?patientId=" . $row['BenhNhanId'] . "' class='a_xoa'>Xóa</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>Không có dữ liệu bạn đã nhập</td></tr>";
          }
        }
      } else {
        $sql = "SELECT * FROM benhnhan ORDER BY BenhNhanId";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr class='td'>";
              echo "<td><strong>" . $row['BenhNhanId'] . "</strong></td>";
              echo "<td>" . $row['TenBenhNhan'] . "</td>";
              echo "<td>" . $row['gioitinh'] . "</td>";
              echo "<td>" . $row['phone'] . "</td>";
              echo "<td><a href='./sua.php?patientId=" . $row['BenhNhanId'] . "' class='a_sua'>Sửa</a>  <a href='./xoa.php?patientId=" . $row['BenhNhanId'] . "' class='a_xoa'>Xóa</a></td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
          }
        } else {
          echo "Lỗi truy vấn: " . mysqli_error($conn);
        }
        mysqli_close($conn);
      }
      ?>

    </table>
  </div>

</body>

</html>