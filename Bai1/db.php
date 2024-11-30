<?php
$host = 'localhost';  // Tên máy chủ
$user = 'root';       // Tên người dùng
$password = 'thangngu123';       // Mật khẩu MySQL
$dbname = 'flower_management';  // Tên cơ sở dữ liệu

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($host, $user, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>