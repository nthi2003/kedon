<?php
require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];

  // Sanitize input to prevent SQL injection
  $id = mysqli_real_escape_string($conn, $id);

  $delete_sql = "DELETE FROM chitietdonthuoc WHERE id = $id";

  if ($conn->query($delete_sql) === TRUE) {
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Lỗi khi xóa: " . $conn->error;
  }
} else {
  echo "Lỗi khi xóa kê đơn thuốc: " . $conn->error;
}
