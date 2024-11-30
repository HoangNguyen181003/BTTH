<!-- add.php -->
<?php include 'db.php'; // Kết nối cơ sở dữ liệu ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hoa mới</title>
</head>
<body>
    <h1>Thêm hoa mới</h1>
    <form action="store.php" method="POST" enctype="multipart/form-data">
        <label for="name">Tên hoa:</label>
        <input type="text" name="name" required>
        <br>
        <label for="description">Mô tả:</label>
        <textarea name="description" required></textarea>
        <br>
        <label for="image">Hình ảnh:</label>
        <input type="file" name="image" required>
        <br>
        <button type="submit">Thêm</button>
    </form>
</body>
</html>
