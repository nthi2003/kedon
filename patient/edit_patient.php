<?php
require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['patientId'])) {
  $patientId = $_GET['patientId'];
  $sql = "SELECT * FROM benhnhan WHERE BenhNhanId = $patientId";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $patient_data = mysqli_fetch_assoc($result);
  } else {
    echo "Không tìm thấy thông tin bệnh nhân.";
    exit();
  }
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $patientId = $_GET['patientId'];
  $updated_name = $_POST['name'];
  $updated_gender = $_POST['gender'];
  $updated_phone = $_POST['phone'];
  $update_sql = "UPDATE benhnhan
  SET TenBenhNhan = '$updated_name', gioitinh = '$updated_gender', phone = '$updated_phone'
  WHERE BenhNhanId = $patientId";
  if ($conn->query($update_sql) === TRUE) {
    echo '<script>alert("Thông tin bệnh nhân đã được cập nhật thành công.");';
    echo 'setTimeout(function() { window.location.href = "./index.php"; }, 500);</script>';
    mysqli_close($conn);
    exit();
  } else {
    echo "Lỗi khi cập nhật: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chỉnh sửa thông tin bệnh nhân</title>
  <link rel="stylesheet" href="../style_light.css">
</head>

<body>
  <header>
    <a href="../index.php">CHỈNH SỬA THÔNG TIN BỆNH NHÂN</a>
  </header>
  <div class="edit-patient-form">
    <h2 style="text-align: center;">CHỈNH SỬA THÔNG TIN</h2>
    <form method="post" class="form">
      <div class="f">
        <label for="name">Họ tên:</label>
        <input type="text" class="form-input" name="name" value="<?php echo $patient_data['TenBenhNhan']; ?>" placeholder="Tên">
      </div>
      <div class="f">
        <label for="gender">Giới tính:</label>
        <input type="text" class="form-input" name="gender" value="<?php echo $patient_data['gioitinh']; ?>" placeholder="Giới tính">
      </div>
      <div class="f">
        <label for="phone">SĐT:</label>
        <input type="text" class="form-input" name="phone" value="<?php echo $patient_data['phone']; ?>" placeholder="Số điện thoại">
      </div>
      <button type="submit" class="button-form">Cập nhật thông tin</button>
    </form>
  </div>

</body>

</html>