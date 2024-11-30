<!-- index.php -->
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
    <title>Danh sách các loài hoa</title>
</head>
<body>
    <h1>Danh sách các loài hoa</h1>
    <?php while ($flower = $result->fetch_assoc()): ?>
        <div>
            <h2><?= $flower['name'] ?></h2>
            <img src="<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>" width="300">
            <p><?= $flower['description'] ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>
