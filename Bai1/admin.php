<!-- admin.php -->
<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

// Lấy danh sách hoa từ cơ sở dữ liệu
$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh sách hoa</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Quản lý danh sách hoa</h1>
    <a href="add.php">Thêm hoa mới</a>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên hoa</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; while ($flower = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $index++ ?></td>
                    <td><?= $flower['name'] ?></td>
                    <td><img src="<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>" width="100"></td>
                    <td><?= $flower['description'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $flower['id'] ?>">Sửa</a> |
                        <a href="delete.php?id=<?= $flower['id'] ?>">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
