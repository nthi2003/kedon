<?php
require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['prescriptionId'])) {
  $prescriptionId = $_GET['prescriptionId'];
  $sql = "SELECT pat.TenBenhNhan AS patientName, pat.gioitinh AS gender, pat.phone AS phone, bs.TenBS AS doctorName
          FROM donthuoc AS dt
          JOIN benhnhan AS pat ON dt.BenhNhanId = pat.BenhNhanId
          JOIN bacsi AS bs ON dt.BacSiId = bs.BacSiId
          WHERE dt.DonThuocId = $prescriptionId";

  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
  } else {
    echo "Không tìm thấy thông tin bệnh nhân.";
    exit();
  }
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $prescriptionId = $_POST['prescriptionId'];
  $updated_doctorId = $_POST['doctor'];

  // Sanitize input to prevent SQL injection
  $prescriptionId = mysqli_real_escape_string($conn, $prescriptionId);
  $updated_doctorId = mysqli_real_escape_string($conn, $updated_doctorId);

  $update_sql = "UPDATE donthuoc
                 SET BacSiId = '$updated_doctorId'
                 WHERE DonThuocId = $prescriptionId";

  if ($conn->query($update_sql) === TRUE) {
    echo '<script>alert("Thông tin bệnh nhân đã được cập nhật thành công.");';
    echo 'setTimeout(function() { window.location.href = "../index.php"; }, 500);</script>';
    mysqli_close($conn);
    exit();
  } else {
    echo "Lỗi khi cập nhật: " . $conn->error;
  }
}
