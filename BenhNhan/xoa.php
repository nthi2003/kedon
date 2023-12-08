<?php
require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['patientId'])) {
  $patientId = $_GET['patientId'];

  // Xóa các thông tin liên quan đến bệnh nhân trước khi xóa bệnh nhân
  $delete_prescriptions_sql = "DELETE FROM donthuoc WHERE BenhNhanId = $patientId";
  $delete_details_sql = "DELETE FROM chitietdonthuoc WHERE DonThuocId IN (SELECT DonThuocId FROM donthuoc WHERE BenhNhanId = $patientId)";

  // Thực hiện xóa thông tin liên quan
  if ($conn->query($delete_details_sql) === TRUE && $conn->query($delete_prescriptions_sql) === TRUE) {
    // Sau đó xóa bệnh nhân
    $delete_patient_sql = "DELETE FROM benhnhan WHERE BenhNhanId = $patientId";

    if ($conn->query($delete_patient_sql) === TRUE) {
      mysqli_close($conn);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    } else {
      echo "Lỗi khi xóa bệnh nhân: " . $conn->error;
    }
  } else {
    echo "Lỗi khi xóa thông tin liên quan: " . $conn->error;
  }
} else {
  echo "Lỗi khi xóa bệnh nhân: Thông tin bệnh nhân không hợp lệ.";
}
