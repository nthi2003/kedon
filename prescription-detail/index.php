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
    <a href="../index.php">QUẢN TRỊ ĐƠN THUỐC</a>
  </header>
  <nav>
    <div class="nav-left-content">
      <a href="../index.php">Trang chủ</a>
      <a href="../patient/new_patient.php">Thêm bệnh nhân</a>
      <a href="../medicine/index.php">Thông tin thuốc</a>
      <a href="./index.php" style="background-color: gray;">Thông tin kê đơn</a>
    </div>

  </nav>
  <div class="content">
    <h2>Thông tin kê thuốc</h2>
    <table>
      <tr class="th">
        <th>Stt</th>
        <th>Bệnh nhân</th>
        <th>Bác sĩ kê đơn</th>
        <th>Tên thuốc</th>
        <th>Liều dùng một lần(viên)</th>
        <th>Số lần dùng trong ngày</th>
        <th>Số ngày uống</th>
        <th>Hành động</th>
      </tr>
      <?php
      require_once '../connection/connect.php';
      $sql = "SELECT del.id AS id, pat.TenBenhNhan AS patientName, doc.TenBS AS doctorName, med.tenThuoc AS medicineName, del.doseOnly AS doseOnly, del.doseDay AS doseDay, del.tinhthuongxuyen AS frequency FROM chitietdonthuoc as del
      JOIN donthuoc AS pre ON del.DonThuocId = pre.DonThuocId
      JOIN benhnhan AS pat ON pre.BenhNhanId = pat.BenhNhanId
      JOIN bacsi AS doc ON pre.BacSiId = doc.BacSiId
      JOIN thuoc AS med ON del.thuocId = med.thuocId";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr class='td'>";
          echo "<td><strong>" . $row['id'] . "</strong></td>";
          echo "<td>" . $row['patientName'] . "</td>";
          echo "<td>" . $row['doctorName'] . "</td>";
          echo "<td>" . $row['medicineName'] . "</td>";
          echo "<td>" . $row['doseOnly'] . "</td>";
          echo "<td>" . $row['doseDay'] . "</td>";
          echo "<td>" . $row['frequency'] . "</td>";
          echo "<td><a href='./delete_prescription_detail.php?id=" . $row['id'] . "' class='a_xoa'>Xóa</a></td>";
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