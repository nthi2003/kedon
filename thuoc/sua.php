<?php
require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['medicineId'])) {
  //kiểm tra xem mã thuốc có chưa tham số hay ko 
  $medicineId = $_GET['medicineId'];

  $sql = "SELECT * FROM thuoc WHERE thuocId = $medicineId";
  $result = mysqli_query($conn, $sql);
  // kiểm tra nếu có mã thuốc thì tiếp tục còn nếu không có thì kết thúc
  if ($result && mysqli_num_rows($result) > 0) {
    $medicine_data = mysqli_fetch_assoc($result);
  } else {
    echo "Không tìm thấy thông tin thuốc.";
    exit();
  }
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $medicineId = $_GET['medicineId'];
  $updated_name = mysqli_real_escape_string($conn, $_POST['name']);
  $updated_doseMin = $_POST['dosemin'];
  $updated_doseMax = $_POST['dosemax'];
  $updated_frequence = $_POST['frequence'];
  $updated_unit = mysqli_real_escape_string($conn, $_POST['unit']); //bảo về trg dữ liệu 

  $update_sql = "UPDATE thuoc
                   SET tenThuoc = '$updated_name', lieuToiThieu = '$updated_doseMin', LieuToiDa = '$updated_doseMax', TanXuat = '$updated_frequence', Donvi = '$updated_unit'
                   WHERE thuocId = $medicineId";

  if ($conn->query($update_sql) === TRUE) {
    echo '<script>alert("Thông tin thuốc đã được cập nhật thành công.");';
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
  <title>Chỉnh sửa thông tin thuốc</title>
  <link rel="stylesheet" href="../style_light.css">
</head>

<body>
  <header>
    <a href="../index.php">CHỈNH SỬA THÔNG TIN THUỐC</a>
  </header>
  <div class="edit-patient-form">
    <h2 style="text-align: center;">CHỈNH SỬA THÔNG TIN</h2>
    <form method="post" class="form">
      <div class="f">
        <label for="name">Thuốc:</label>
        <input type="text" class="form-input" name="name" value="<?php echo $medicine_data['tenThuoc']; ?>" placeholder="Tên thuốc">
      </div>
      <div class="f">
        <label for="dosemin">Liều dùng tối thiểu:</label>
        <input type="text" class="form-input" name="dosemin" value="<?php echo $medicine_data['lieuToiThieu']; ?>" placeholder="Liều dùng tối thiểu">
      </div>
      <div class="f">
        <label for="dosemax">Liều dùng tối đa:</label>
        <input type="text" class="form-input" name="dosemax" value="<?php echo $medicine_data['LieuToiDa']; ?>" placeholder="Liều dùng tối đa">
      </div>
      <div class="f">
        <label for="frequence">Tần suất:</label>
        <input type="text" class="form-input" name="frequence" value="<?php echo $medicine_data['TanXuat']; ?>" placeholder="Tần suất">
      </div>
      <div class="f">
        <label for="unit">Đơn vị:</label>
        <input type="text" class="form-input" name="unit" value="<?php echo $medicine_data['Donvi']; ?>" placeholder="Đơn vị">
      </div>
      <button type="submit" class="button-form">Cập nhật thông tin</button>
    </form>
  </div>
</body>

</html>