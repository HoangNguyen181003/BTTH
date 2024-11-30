<!-- edit.php -->
<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM flowers WHERE id = $id";
    $result = $conn->query($sql);
    $flower = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin hoa</title>
</head>
<body>
    <h1>Sửa thông tin hoa</h1>
    <form
