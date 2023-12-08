<?php
require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $patientId = $_POST['patient'];
  $dayStart = str_replace('T', ' ', $_POST['dayStart']);
  $dayEnd = str_replace('T', ' ', $_POST['dayEnd']);
  $doctorId = $_POST['doctor'];

  // Sanitize input to prevent SQL injection
  $patientId = mysqli_real_escape_string($conn, $patientId);
  $dayStart = mysqli_real_escape_string($conn, $dayStart);
  $dayEnd = mysqli_real_escape_string($conn, $dayEnd);
  $doctorId = mysqli_real_escape_string($conn, $doctorId);

  $sql = "INSERT INTO donthuoc(BacSiId, BenhNhanId, NgayBatdau, NgayKetThuc) VALUES ($doctorId, $patientId, '$dayStart', '$dayEnd')";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Thông tin đơn thuốc đã được lưu thành công.");';
    echo 'setTimeout(function() { window.location.href = "../index.php"; }, 500);</script>';
    mysqli_close($conn);
    exit();
  } else {
    echo "Lỗi khi lưu: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm thông tin đơn thuốc</title>
  <link rel="stylesheet" href="../style_light.css">
</head>

<body>
  <header>
    <a href="../index.php">THÊM THÔNG TIN ĐƠN THUỐC</a>
  </header>
  <div class="edit-patient-form">
    <h2 style="text-align: center;">THÊM THÔNG TIN</h2>
    <form method="post" class="form">
      <div class="f">
        <label for="patient">Họ tên</label>
        <?php
        require_once '../connection/connect.php';
        $sql = 'SELECT BenhNhanId, TenBenhNhan FROM benhnhan';
        $result = $conn->query($sql);

        if ($result) {
          echo '<select class="form-input" name="patient" >';
          echo '<option value="0">Chọn bệnh nhân</option>';
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['BenhNhanId'] . '">' . $row['TenBenhNhan'] . '</option>';
          }

          echo '</select>';
        } else {
          die('Error: ' . mysqli_error($conn));
        }
        ?>
      </div>
      <div class="f">
        <label for="dayStart">Ngày bắt đầu:</label>
        <input type="datetime-local" class="form-input" name="dayStart">
      </div>
      <div class="f">
        <label for="dayEnd">Ngày kết thúc:</label>
        <input type="datetime-local" class="form-input" name="dayEnd">
      </div>
      <div class="f">
        <label for="doctor">Bác sĩ</label>
        <?php
        require_once '../connection/connect.php';
        $sql = 'SELECT BacSiId, TenBS FROM bacsi';
        $result = $conn->query($sql);

        if ($result) {
          echo '<select class="form-input" name="doctor" >';
          echo '<option value="0">Chọn bác sĩ</option>';
          while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['BacSiId'] . '">' . $row['TenBS'] . '</option>';
          }

          echo '</select>';
        } else {
          die('Error: ' . mysqli_error($conn));
        }
        ?>
      </div>
      <button type="submit" class="button-form">Lưu</button>
    </form>
  </div>
</body>

</html>