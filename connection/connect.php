<?php
$servername = "localhost"; // Tên máy chủ MySQL
$username = "root"; // Tên người dùng MySQL
$password = "";
$database = "dtthuoc";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
  die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
} else {
}
