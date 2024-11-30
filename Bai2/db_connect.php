<?php
$servername = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root"; // Tên người dùng MySQL
$password = "thangngu123"; // Mật khẩu MySQL
$dbname = "quiz_db"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error); // Nếu kết nối thất bại, dừng và hiển thị lỗi
} else {
   // echo "Kết nối thành công đến cơ sở dữ liệu: $dbname"; // Nếu kết nối thành công, hiển thị thông báo
}

// Đóng kết nối sau khi hoàn tất
?>
