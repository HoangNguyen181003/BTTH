<!-- delete.php -->
<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM flowers WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Hoa đã được xóa thành công!";
        header("Location: admin.php"); // Chuyển hướng về trang danh sách hoa
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
