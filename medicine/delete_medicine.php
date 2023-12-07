<?php
require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['thuocId'])) {
  $thuocId = $_GET['thuocId'];
  $delete_sql = "DELETE FROM thuoc WHERE thuocId = $thuocId";

  if ($conn->query($delete_sql) === TRUE) {
    mysqli_close($conn);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } else {
    echo "Lỗi khi xóa: " . $conn->error;
  }
} else {
  echo "Lỗi khi xóa thuốc: " . $conn->error;
}
