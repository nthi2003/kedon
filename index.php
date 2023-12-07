<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kê đơn thuốc</title>
  <link rel="stylesheet" href="./style_light.css">
</head>

<body>
  <header>
    <a href="./index.php">QUẢN TRỊ ĐƠN THUỐC</a>
  </header>
  <nav>
    <div class="nav-left-content">
      <a href="./index.php" style="background-color: gray;">Trang chủ</a>
      <a href="./patient/new_patient.php">Thêm bệnh nhân</a>
      <a href="./medicine/index.php">Thông tin thuốc</a>
      <a href="./prescription-detail/index.php">Thông tin kê đơn</a>
    </div>
    <div class="nav-right-content">
      <div>Xin chào</div>
      <img src="./img/expand_more.svg" alt="menu">
    </div>
  </nav>
  <div class="content">
    <h2>Danh sách đơn thuốc</h2>
    <div class="new-patient-button">
      <a href="./prescription/new_prescription.php">Thêm đơn thuốc</a>
    </div>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Tên bệnh nhân</th>
        <th>Giới tính</th>
        <th>Số điện thoại</th>
        <th>Bác sĩ phụ trách</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Hành động</th>
      </tr>
      <?php
      require_once './connection/connect.php';
      $sql = "SELECT dt.DonThuocId, bn.TenBenhNhan, bn.gioitinh, bn.phone, bs.TenBS, dt.NgayBatdau, dt.NgayKetThuc FROM donthuoc AS dt
        JOIN benhnhan AS bn ON dt.BenhNhanId = bn.BenhNhanId
        JOIN bacsi AS bs ON dt.BacSiId = bs.BacSiId
        ORDER BY dt.DonThuocId";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='td'>";
          echo "<td><strong>" . $row['DonThuocId'] . "</strong></td>";
          echo "<td>" . $row['TenBenhNhan'] . "</td>";
          echo "<td>" . $row['gioitinh'] . "</td>";
          echo "<td>" . $row['phone'] . "</td>";
          echo "<td>" . $row['TenBS'] . "</td>";
          echo "<td>" . strstr($row['NgayBatdau'], ' ', true) . "</td>";
          echo "<td>" . strstr($row['NgayKetThuc'], ' ', true) . "</td>";
          echo "<td><a href='./prescription-detail/new_prescription_detail.php?prescriptionId=" . $row['DonThuocId'] . "' class='a_kedon'>Kê đơn</a> <a href='./prescription/edit_prescription.php?prescriptionId=" . $row['DonThuocId'] . "' class='a_sua'>Sửa</a> <a href='./prescription/delete_prescription.php?prescriptionId=" . $row['DonThuocId'] . "' class='a_xoa'>Xóa</a></td>";
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